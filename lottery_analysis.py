import requests
from collections import Counter
import random

def get_lottery_data():
    base_url = "https://www.dhlottery.co.kr/common.do"
    params = {
        "method": "getLottoNumber",
        "drwNo": ""
    }

    data = []
    for i in range(1, 101):  # 최근 100회
        params["drwNo"] = i
        response = requests.get(base_url, params=params)
        result = response.json()

        if result["returnValue"] == "success":
            numbers = [
                result["drwtNo1"],
                result["drwtNo2"],
                result["drwtNo3"],
                result["drwtNo4"],
                result["drwtNo5"],
                result["drwtNo6"]
            ]
            data.append(numbers)

    return data

def analyze_numbers(data):
    # 모든 당첨번호의 빈도수 분석
    all_numbers = [num for draw in data for num in draw]
    number_freq = Counter(all_numbers)

    # 가장 자주 나온 번호
    most_common = number_freq.most_common(10)

    # 최근 10회 분석
    recent_10 = data[:10]
    recent_numbers = [num for draw in recent_10 for num in draw]
    recent_freq = Counter(recent_numbers)

    # 번호대별 분석
    number_ranges = {
        "1-10": 0, "11-20": 0, "21-30": 0,
        "31-40": 0, "41-45": 0
    }

    for num in all_numbers:
        if 1 <= num <= 10:
            number_ranges["1-10"] += 1
        elif 11 <= num <= 20:
            number_ranges["11-20"] += 1
        elif 21 <= num <= 30:
            number_ranges["21-30"] += 1
        elif 31 <= num <= 40:
            number_ranges["31-40"] += 1
        else:
            number_ranges["41-45"] += 1

    return most_common, recent_freq, number_ranges

def predict_next_numbers():
    data = get_lottery_data()
    most_common, recent_freq, number_ranges = analyze_numbers(data)

    # 예측 로직
    predicted_numbers = set()

    # 가장 자주 나온 번호 중에서 선택
    for num, _ in most_common[:3]:
        if len(predicted_numbers) < 6:
            predicted_numbers.add(num)

    # 최근 10회에서 자주 나온 번호 중에서 선택
    for num, _ in recent_freq.most_common(3):
        if len(predicted_numbers) < 6:
            predicted_numbers.add(num)

    # 번호대별 균형을 맞추기 위해 추가
    while len(predicted_numbers) < 6:
        for range_key, count in number_ranges.items():
            start, end = map(int, range_key.split("-"))
            if count < sum(number_ranges.values()) / len(number_ranges):
                available_numbers = set(range(start, end + 1)) - predicted_numbers
                if available_numbers:
                    predicted_numbers.add(random.choice(list(available_numbers)))
                    break

    return sorted(list(predicted_numbers))

if __name__ == "__main__":
    print("\n=== 다음 회차 예측 번호 (10세트) ===")
    for i in range(10):
        predicted = predict_next_numbers()
        print(f"세트 {i+1}: {predicted}")
    print("\n※ 이는 통계적 분석을 통한 예측이며, 실제 당첨을 보장하지 않습니다.")

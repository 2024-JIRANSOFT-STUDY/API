<?php

declare(strict_types=1);

return [
    'accepted'             => ':Attribute을(를) 동의해야 합니다.',
    'accepted_if'          => ':Attribute을(를) :other이(가) :value이면 동의해야 합니다.',
    'active_url'           => ':Attribute은(는) 유효한 URL이 아닙니다.',
    'after'                => ':Attribute은(는) :date 이후 날짜여야 합니다.',
    'after_or_equal'       => ':Attribute은(는) :date 이후 날짜이거나 같은 날짜여야 합니다.',
    'alpha'                => ':Attribute은(는) 문자만 포함할 수 있습니다.',
    'alpha_dash'           => ':Attribute은(는) 문자, 숫자, 대쉬(-), 밑줄(_)만 포함할 수 있습니다.',
    'alpha_num'            => ':Attribute은(는) 문자와 숫자만 포함할 수 있습니다.',
    'array'                => ':Attribute은(는) 배열이어야 합니다.',
    'before'               => ':Attribute은(는) :date 이전 날짜여야 합니다.',
    'before_or_equal'      => ':Attribute은(는) :date 이전 날짜이거나 같은 날짜여야 합니다.',
    'between'              => [
        'array'   => ':Attribute의 항목 수는 :min에서 :max 개의 항목이 있어야 합니다.',
        'file'    => ':Attribute의 용량은 :min에서 :max 킬로바이트 사이여야 합니다.',
        'numeric' => ':Attribute의 값은 :min에서 :max 사이여야 합니다.',
        'string'  => ':Attribute의 길이는 :min에서 :max 문자 사이여야 합니다.',
    ],
    'boolean'              => ':Attribute은(는) true 또는 false 이어야 합니다.',
    'confirmed'            => ':Attribute 확인 항목이 일치하지 않습니다.',
    'current_password'     => '패스워드가 일치하지 않습니다.',
    'date'                 => ':Attribute은(는) 유효한 날짜가 아닙니다.',
    'date_equals'          => ':Attribute은(는) :date과(와) 같은날짜여야합니다.',
    'date_format'          => ':Attribute이(가) :format 형식과 일치하지 않습니다.',
    'declined'             => ':Attribute은(는) 거부되어야 합니다.',
    'declined_if'          => ':Other이(가) :value일때 :attribute은(는) 거부되어야 합니다.',
    'different'            => ':Attribute와(과) :other은(는) 서로 달라야 합니다.',
    'digits'               => ':Attribute은(는) :digits 자리 숫자여야 합니다.',
    'digits_between'       => ':Attribute은(는) :min에서 :max 자리 사이여야 합니다.',
    'dimensions'           => ':Attribute은(는) 올바르지 않는 이미지 크기입니다.',
    'distinct'             => ':Attribute 필드에 중복된 값이 있습니다.',
    'doesnt_end_with'      => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with'    => 'The :attribute may not start with one of the following: :values.',
    'email'                => ':Attribute은(는) 유효한 이메일 주소여야 합니다.',
    'ends_with'            => ':Attribute은(는) 다음 중 하나로 끝나야 합니다: :values.',
    'enum'                 => ':Attribute의 값이 잘못되었습니다.',
    'exists'               => ':Attribute이(가) 존재하지 않습니다.',
    'file'                 => ':Attribute은(는) 파일이어야 합니다.',
    'filled'               => ':Attribute 필드는 값이 있어야 합니다.',
    'gt'                   => [
        'array'   => ':Attribute의 항목 수는 :value개 보다 많아야 합니다.',
        'file'    => ':Attribute의 용량은 :value킬로바이트보다 커야 합니다.',
        'numeric' => ':Attribute의 값은 :value보다 커야 합니다.',
        'string'  => ':Attribute의 길이는 :value보다 길어야 합니다.',
    ],
    'gte'                  => [
        'array'   => ':Attribute의 항목 수는 :value개 보다 같거나 많아야 합니다.',
        'file'    => ':Attribute의 용량은 :value킬로바이트보다 같거나 커야 합니다.',
        'numeric' => ':Attribute의 값은 :value보다 같거나 커야 합니다.',
        'string'  => ':Attribute의 길이는 :value보다 같거나 길어야 합니다.',
    ],
    'image'                => ':Attribute은(는) 이미지여야 합니다.',
    'in'                   => '선택된 :attribute은(는) 올바르지 않습니다.',
    'in_array'             => ':Attribute 필드는 :other에 존재하지 않습니다.',
    'integer'              => ':Attribute은(는) 정수여야 합니다.',
    'ip'                   => ':Attribute은(는) 유효한 IP 주소여야 합니다.',
    'ipv4'                 => ':Attribute은(는) 유효한 IPv4 주소여야 합니다.',
    'ipv6'                 => ':Attribute은(는) 유효한 IPv6 주소여야 합니다.',
    'json'                 => ':Attribute은(는) JSON 문자열이어야 합니다.',
    'lowercase'            => 'The :attribute must be lowercase.',
    'lt'                   => [
        'array'   => ':Attribute의 항목 수는 :value개 보다 작아야 합니다.',
        'file'    => ':Attribute의 용량은 :value킬로바이트보다 작아야 합니다.',
        'numeric' => ':Attribute의 값은 :value보다 작아야 합니다.',
        'string'  => ':Attribute의 길이는 :value보다 짧아야 합니다.',
    ],
    'lte'                  => [
        'array'   => ':Attribute의 항목 수는 :value개 보다 같거나 작아야 합니다.',
        'file'    => ':Attribute의 용량은 :value킬로바이트보다 같거나 작아야 합니다.',
        'numeric' => ':Attribute의 값은 :value보다 같거나 작아야 합니다.',
        'string'  => ':Attribute의 길이는 :value보다 같거나 짧아야 합니다.',
    ],
    'mac_address'          => ':Attribute은(는) 올바른 MAC 주소가 아닙니다.',
    'max'                  => [
        'array'   => ':Attribute은(는) :max개보다 많을 수 없습니다.',
        'file'    => ':Attribute은(는) :max킬로바이트보다 클 수 없습니다.',
        'numeric' => ':Attribute은(는) :max보다 클 수 없습니다.',
        'string'  => ':Attribute은(는) :max자보다 클 수 없습니다.',
    ],
    'max_digits'           => 'The :attribute must not have more than :max digits.',
    'mimes'                => ':Attribute은(는) 다음의 파일 형식이어야 합니다: :values.',
    'mimetypes'            => ':Attribute은(는) 다음의 파일 형식이어야 합니다: :values.',
    'min'                  => [
        'array'   => ':Attribute은(는) 최소한 :min개의 항목이 있어야 합니다.',
        'file'    => ':Attribute은(는) 최소한 :min킬로바이트이어야 합니다.',
        'numeric' => ':Attribute은(는) 최소한 :min이어야 합니다.',
        'string'  => ':Attribute은(는) 최소한 :min자이어야 합니다.',
    ],
    'min_digits'           => 'The :attribute must have at least :min digits.',
    'multiple_of'          => ':Attribute 는 :value 의 배수여야 합니다.',
    'not_in'               => '선택된 :attribute이(가) 올바르지 않습니다.',
    'not_regex'            => ':Attribute의 형식이 올바르지 않습니다.',
    'numeric'              => ':Attribute은(는) 숫자여야 합니다.',
    'password'             => [
        'letters'       => 'The :attribute must contain at least one letter.',
        'mixed'         => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers'       => 'The :attribute must contain at least one number.',
        'symbols'       => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present'              => ':Attribute 필드가 있어야 합니다.',
    'prohibited'           => ':Attribute (은)는 금지되어 있습니다.',
    'prohibited_if'        => ':Attribute (은)는 :other 이(가) :value 인 경우 금지되어 있습니다.',
    'prohibited_unless'    => ':Attribute (은)는 :other 이(가) :value 이(가) 아닌 경우 금지되어 있습니다.',
    'prohibits'            => ':Attribute (은)는 :other 을(를) 금지합니다.',
    'regex'                => ':Attribute 형식이 올바르지 않습니다.',
    'required'             => ':Attribute 필드는 필수입니다.',
    'required_array_keys'  => 'The :attribute field must contain entries for: :values.',
    'required_if'          => ':Other이(가) :value 일 때 :attribute 필드는 필수입니다.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless'      => ':Other이(가) :values에 없다면 :attribute 필드는 필수입니다.',
    'required_with'        => ':Values이(가) 있는 경우 :attribute 필드는 필수입니다.',
    'required_with_all'    => ':Values이(가) 모두 있는 경우 :attribute 필드는 필수입니다.',
    'required_without'     => ':Values이(가) 없는 경우 :attribute 필드는 필수입니다.',
    'required_without_all' => ':Values이(가) 모두 없는 경우 :attribute 필드는 필수입니다.',
    'same'                 => ':Attribute와(과) :other은(는) 일치해야 합니다.',
    'size'                 => [
        'array'   => ':Attribute은(는) :size개의 항목을 포함해야 합니다.',
        'file'    => ':Attribute은(는) :size킬로바이트여야 합니다.',
        'numeric' => ':Attribute은(는) :size (이)여야 합니다.',
        'string'  => ':Attribute은(는) :size자여야 합니다.',
    ],
    'starts_with'          => ':Attribute은(는) :values 중 하나로 시작해야 합니다.',
    'string'               => ':Attribute은(는) 문자열이어야 합니다.',
    'timezone'             => ':Attribute은(는) 올바른 시간대 이어야 합니다.',
    'unique'               => ':Attribute은(는) 이미 사용 중입니다.',
    'uploaded'             => ':Attribute을(를) 업로드하지 못했습니다.',
    'uppercase'            => 'The :attribute must be uppercase.',
    'url'                  => ':Attribute은(는) 형식은 올바르지 않습니다.',
    'uuid'                 => ':Attribute은(는) 유효한UUID여야합니다.',
    'attributes'           => [
        'address'                  => '주소',
        'age'                      => '나이',
        'amount'                   => 'amount',
        'area'                     => 'area',
        'available'                => 'available',
        'birthday'                 => 'birthday',
        'body'                     => '몸',
        'city'                     => '도시',
        'content'                  => '내용',
        'country'                  => '나라',
        'created_at'               => 'created at',
        'creator'                  => 'creator',
        'current_password'         => 'current password',
        'date'                     => '날짜',
        'date_of_birth'            => 'date of birth',
        'day'                      => '일',
        'deleted_at'               => 'deleted at',
        'description'              => '상세설명',
        'district'                 => 'district',
        'duration'                 => 'duration',
        'email'                    => '이메일',
        'excerpt'                  => '발췌',
        'filter'                   => 'filter',
        'first_name'               => '이름',
        'gender'                   => '성별',
        'group'                    => 'group',
        'hour'                     => '시',
        'image'                    => 'image',
        'last_name'                => '성',
        'lesson'                   => 'lesson',
        'line_address_1'           => 'line address 1',
        'line_address_2'           => 'line address 2',
        'message'                  => '메시지',
        'middle_name'              => 'middle name',
        'minute'                   => '분',
        'mobile'                   => '모바일',
        'month'                    => '월',
        'name'                     => '이름',
        'national_code'            => 'national code',
        'number'                   => 'number',
        'password'                 => '비밀번호',
        'password_confirmation'    => '비밀번호 확인',
        'phone'                    => '전화번호',
        'photo'                    => '사진',
        'postal_code'              => 'postal code',
        'price'                    => '가격',
        'province'                 => 'province',
        'recaptcha_response_field' => 'recaptcha response field',
        'remember'                 => 'remember',
        'restored_at'              => 'restored at',
        'result_text_under_image'  => 'result text under image',
        'role'                     => '규칙',
        'second'                   => '초',
        'sex'                      => '성별',
        'short_text'               => 'short text',
        'size'                     => 'size',
        'state'                    => 'state',
        'street'                   => 'street',
        'student'                  => 'student',
        'subject'                  => '주제',
        'teacher'                  => 'teacher',
        'terms'                    => '약관',
        'test_description'         => 'test description',
        'test_locale'              => 'test locale',
        'test_name'                => 'test name',
        'text'                     => 'text',
        'time'                     => '시간',
        'title'                    => '제목',
        'updated_at'               => 'updated at',
        'username'                 => '유저이름',
        'year'                     => '년',
    ],
];

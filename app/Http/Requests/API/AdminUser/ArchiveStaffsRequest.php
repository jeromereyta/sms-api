<?php

declare(strict_types=1);

namespace App\Http\Requests\API\AdminUser;

use App\Http\Requests\BaseRequest;

final class ArchiveStaffsRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getUserIds(): array
    {
        return $this->get('user_ids');
    }

    public function rules(): array
    {
        return [
            'user_ids' => 'required|array',
        ];
    }
}

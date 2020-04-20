<?php

namespace Modules\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Authorization\Role\Resources\RoleResource;
use Modules\User\Models\User;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'registeredAt' => $this->registered_at,
            'emailVerifiedAt' => $this->email_verified_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}

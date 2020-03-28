<?php

namespace Modules\Authorization\Role\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Authorization\Permission\Resources\PermissionResource;
use Modules\Authorization\Role\Model\Role;

/**
 * Class RoleResource
 * @package Modules\Authorization\Role\Resources
 * @mixin Role
 */
class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'translatableName' => $this->translatable_name,
            'createdAt'        => $this->created_at,
            'updatedAt'        => $this->updated_at,
            'permissions'      => PermissionResource::collection($this->whenLoaded('permissions')),
        ];
    }
}

<?php

namespace Modules\Authorization\Permission\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Authorization\Permission\Model\Permission;

/**
 * Class PermissionResource
 * @package Modules\Authorization\Permission\Resources
 * @mixin Permission
 */
class PermissionResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->key,
            'translatableName' => $this->translatable_name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}

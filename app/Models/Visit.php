<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Visit",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The visit ID"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the visit"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="The email of the visit"
 *     ),
 *     @OA\Property(
 *         property="latitude",
 *         type="string",
 *         description="The latitude of the visit"
 *     ),
 *     @OA\Property(
 *         property="longitude",
 *         type="string",
 *         description="The longitude of the visit"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The creation timestamp of the visit"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The update timestamp of the visit"
 *     )
 * )
 */
class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'latitude', 'longitude'];
}

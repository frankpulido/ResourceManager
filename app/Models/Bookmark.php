<?php
declare(strict_types = 1);

namespace App\Models;

use App\Observers\BookmarkObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Bookmark",
 *     type="object",
 *     title="Bookmark",
 *     @OA\Property(property="id", type="integer", example=9),
 *     @OA\Property(property="user_id", type="integer", description="Foreign key representing the ID of the user", example=6729608),
 *     @OA\Property(property="resource_id", type="integer", description="Foreign key representing the ID of the bookmarked resource", example=10),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-17T19:23:41.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-17T19:23:41.000000Z")
 * )
*/

#[ObservedBy(BookmarkObserver::class)]
class Bookmark extends Model
{
    use HasFactory;
    protected $table = 'bookmarks';
    protected $fillable = ['user_id', 'resource_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}

<?php
declare(strict_types=1);

namespace App\Models;

use App\Observers\CommentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Comment",
 *     type="object",
 *     title="Comment",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", description="Foreign key representing the ID of the user", example=6729608),
 *     @OA\Property(property="resource_id", type="integer", description="Foreign key representing the ID of the resource", example=10),
 *     @OA\Property(property="comment", type="text", description="The comment text", example="This is a comment."),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-17T19:23:41.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-17T19:23:41.000000Z")
 *)
*/

#[ObservedBy(CommentObserver::class)]
class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'resource_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}

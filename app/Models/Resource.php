<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Resource",
 *     type="object",
 *     title="Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=12345),
 *     @OA\Property(property="title", type="string", nullable=true, example="Lorem Ipsum ..."),
 *     @OA\Property(property="description", type="string", nullable=true, example="Lorem Ipsum ..."),
 *     @OA\Property(property="url", type="string", nullable=true, example="https://www.hola.com", format="url"),
 *     @OA\Property(property="category", type="string", enum={"Node","React","Angular","JavaScript","Java","Fullstack PHP", "Data Science","BBDD"}, example="Node"),
 *     @OA\Property(property="tags", type="array", @OA\items(type="string"), example={"Components","UseState & UseEffect","Eventos" ,"Renderizado condicional","Listas","Estilos","Debugging","React Router"}), description="Array of tags",
 *     @OA\Property(property="type", type="string", enum={"Video","Cursos","Blog"}, example="Video"),
 *     @OA\Property(property="bookmark_count", type="integer", example = 1),
 *     @OA\Property(property="like_count", type="integer", example = 1),
 *     @OA\Property(property="comment_count", type="integer", example = 1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-17T19:23:41.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-17T19:23:41.000000Z")
 * )
*/

class Resource extends Model
{
    use HasFactory;
    protected $table = 'resources';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'url',
        'category',
        'tags',
        'type',
        'bookmark_count',
        'like_count',
        'comment_count'
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

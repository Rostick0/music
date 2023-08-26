<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'type',
        'user_id',
    ];

    public static function selectMusicNoAuth(Model $model, string $table_name, string $table_type, $ids)
    {
        return $model::select(
            "$table_name.*",
            'music_artists.name as music_artist_name',
            DB::raw("NULL as `type`"),
            DB::raw("NULL as `type_id`"),
            DB::raw("'$table_type' as `table_type`"),
        )
            ->join('music_artists', "$table_name.music_artist_id", '=', 'music_artists.id')
            ->whereIn("$table_name.id", $ids);
    }

    public static function selectMusicPartNoAuth(string $table_name, string $table_type, $ids)
    {
        return MusicPart::select(
            "music_parts.id as id",
            "$table_name.music_artist_id as music_artist_id",
            "music_parts.title as title",
            "music_parts.link as link",
            DB::raw("NULL as `link_demo`"),
            DB::raw("NULL as `publisher`"),
            DB::raw("NULL as `distr`"),
            DB::raw("NULL as `is_active`"),
            DB::raw("NULL as `is_free`"),
            DB::raw("NULL as `description`"),
            "$table_name.image as image",
            "music_parts.duration as duration",
            DB::raw("NULL as `seo_title`"),
            DB::raw("NULL as `seo_description`"),
            "music_parts.created_at as created_at",
            "music_parts.updated_at as updated_at",
            'music_artists.name as music_artist_name',
            "music_parts.type as type",
            "music_parts.type_id as type_id",
            DB::raw("'muisc_part' as `table_type`"),
        )
            ->join($table_name, "$table_name.id", '=', 'music_parts.type_id')
            ->join('music_artists', "$table_name.music_artist_id", '=', 'music_artists.id')
            ->whereIn("music_parts.id", $ids)
            ->where('music_parts.type', $table_type);
    }

    public static function selectMusic(Model $model, string $table_name, string $table_type)
    {
        return $model::select(
            "$table_name.*",
            'music_artists.name as music_artist_name',
            DB::raw("NULL as `type`"),
            DB::raw("NULL as `type_id`"),
            DB::raw("'$table_type' as `table_type`"),
            'favorites.id as favorite_id'
        )
            ->join('music_artists', "$table_name.music_artist_id", '=', 'music_artists.id')
            ->join('favorites', 'favorites.type_id', '=', "$table_name.id")
            ->where('favorites.type', $table_type)
            ->where('favorites.user_id', auth()->id());
    }

    public static function selectMusicPart(string $table_name, string $table_type)
    {
        return MusicPart::select(
            "music_parts.id as id",
            "$table_name.music_artist_id as music_artist_id",
            "music_parts.title as title",
            "music_parts.link as link",
            DB::raw("NULL as `link_demo`"),
            DB::raw("NULL as `publisher`"),
            DB::raw("NULL as `distr`"),
            DB::raw("NULL as `is_active`"),
            DB::raw("NULL as `is_free`"),
            DB::raw("NULL as `description`"),
            "$table_name.image as image",
            "music_parts.duration as duration",
            DB::raw("NULL as `seo_title`"),
            DB::raw("NULL as `seo_description`"),
            "music_parts.created_at as created_at",
            "music_parts.updated_at as updated_at",
            'music_artists.name as music_artist_name',
            "music_parts.type as type",
            "music_parts.type_id as type_id",
            DB::raw("'muisc_part' as `table_type`"),
            'favorites.id as favorite_id'
        )
            ->join($table_name, "$table_name.id", '=', 'music_parts.type_id')
            ->join('music_artists', "$table_name.music_artist_id", '=', 'music_artists.id')
            ->join('favorites', 'favorites.type_id', '=', 'music_parts.id')
            ->where('favorites.type', 'part')
            ->where('favorites.user_id', auth()->id());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RemoveClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeletedController extends Controller
{
    private function getTypeRu(string $type)
    {
        switch ($type) {
            case 'music':
                return 'Музыку';
            case 'components':
                return 'Компонент';
            case 'site_pages':
                return 'Страницу';
            case 'users':
                return 'Пользователя';
            case 'music_kits':
                return 'Music kit';
            case 'playlists':
                return 'Плейлист';
            case 'genres':
                return 'Жанр';
            case 'themes':
                return 'Тему';
            case 'moods':
                return 'Настроение';
            case 'instruments':
                return 'Инсутрмент';
            default:
                return '';
        }
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'type_id' => 'required|numeric',
            'type' => 'required|in:music,components,site_pages,users,music_kits,playlists,genres,themes,moods,instruments'
        ]);

        $data = DB::table($request->type)->where('id', $request->type_id)->first();

        if ($request->type == 'users') {
            RemoveClaim::where('user_id', $request->type_id)->delete();
        }

        if (!$data) return abort(404);

        $type = $request->type;
        $type_ru = $this->getTypeRu($type);

        if ($type[strlen($type) - 1] === 's') {
            $type = mb_substr($request->type, 0, -1);
        }

        return view('admin.delete_confirm', [
            'type_id' => $request->type_id,
            'type' => $type,
            'data' => $data,
            'type_ru' => $type_ru
        ]);
    }

    public function show(Request $request)
    {
        $text = $request->text;

        return view('admin.deleted', [
            'text' => $text
        ]);
    }
}

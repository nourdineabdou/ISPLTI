<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

/**
 * Enregistrement des fichiers envoyes par les utilisateurs.
 *
 * Le fichier temporaire de PHP est cree en 0600 : s'il est deplace tel quel
 * dans public/, le serveur web ne peut pas le lire et le site repond 404.
 * Ici on cree le dossier si besoin et on fixe toujours des droits lisibles.
 */
class Upload
{
    const FILE_MODE = 0644;
    const DIR_MODE = 0755;

    /**
     * Enregistre $file au chemin absolu $destination et retourne ce chemin.
     */
    public static function save(UploadedFile|string $file, string $destination): string
    {
        $source = $file instanceof UploadedFile ? $file->getRealPath() : $file;

        $dir = dirname($destination);
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, self::DIR_MODE, true);
        }

        File::copy($source, $destination);
        @chmod($destination, self::FILE_MODE);

        return $destination;
    }
}

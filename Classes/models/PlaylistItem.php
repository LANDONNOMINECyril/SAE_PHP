<?php

namespace Classes\models;

class PlaylistItem
{
    private int $playlist_item_id;
    private int $playlist_id;
    private int $album_id;
    private int $ordre;

    public function getPlaylistItemId(): int
    {
        return $this->playlist_item_id;
    }

    public function setPlaylistItemId(int $playlist_item_id): void
    {
        $this->playlist_item_id = $playlist_item_id;
    }

    public function getPlaylistId(): int
    {
        return $this->playlist_id;
    }

    public function setPlaylistId(int $playlist_id): void
    {
        $this->playlist_id = $playlist_id;
    }

    public function getAlbumId(): int
    {
        return $this->album_id;
    }

    public function setAlbumId(int $album_id): void
    {
        $this->album_id = $album_id;
    }

    public function getOrdre(): int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): void
    {
        $this->ordre = $ordre;
    }
}

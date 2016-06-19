<?php

namespace App\Repositories;

use App\Book;
use App\Shelf;

class BookRepository
{
    public function findByVolumeIdOrCreate($bookData)
    {
        $book = Book::where('google_volume_id', $bookData['google_volume_id'])->first();
        if (empty($book)) {
            $book = Book::create($bookData);
            $book->authors()->attach($bookData['authors']);
            $book->categories()->attach($bookData['categories']);
        }
        return $book;
    }

    public function extractGoogleVolumeData($item)
    {
        return [
                'google_volume_id' => $item['id'],
                'title' => $item['volumeInfo']['title'],
                // 'isbn_10' => $item['volumeInfo']['industryIdentifiers']['ISBN_10'],
                // 'isbn_13' => $item['volumeInfo']['industryIdentifiers']['ISBN_13'],
                'subtitle' => $item['volumeInfo']['subtitle'],
                'description' => $item['volumeInfo']['description'],
                'publisher' => $item['volumeInfo']['publisher'],
                'published_date' => $item['volumeInfo']['publishedDate'],
                'page_count' => $item['volumeInfo']['pageCount'],
                'google_average_rating' => $item['volumeInfo']['averageRating'],
                'google_ratings_count' => $item['volumeInfo']['ratingsCount'],
                'image' => $item['volumeInfo']['imageLinks']['thumbnail'],
                'language' => $item['volumeInfo']['language'],
                'google_info_link' => $item['volumeInfo']['infoLink'],
                'categories' => $item['volumeInfo']['categories'],
                'authors' => $item['volumeInfo']['authors'],
        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $baseUrl = 'https://api.themoviedb.org/3/';
    private $token = 'api_key=1f54bd990f1cdfb230adb312546d765d';

    public function getByPage(int $page = 1) {

        $url = $this->baseUrl .'discover/movie?'. $this->token . '&page=' . $page;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);
        //$result = json_encode($result);

        curl_close($ch);

        return $result;

    }

    public function getByTopRated(int $page = 1) {

        $url = '';

        $url = $this->baseUrl .'movie/top_rated?'. $this->token . '&page=' . $page . '&language=en-US';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);
        //$result = json_encode($result);

        curl_close($ch);

        return $result;

    }

    public function getByGenres( int $genresId = 0) {
        $url = '';

        if( $genresId == 0)
            $url = $this->baseUrl .'genre/movie/list?'. $this->token .'&language=en-US';
        else
            $url =  $this->baseUrl .'discover/movie?'. $this->token .'&with_genres='. $genresId;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);
        //$result = json_encode($result);

        curl_close($ch);

        return $result;
    }

    public function getMovie( int $movieId) {
        $urlMovie = $this->baseUrl .'movie/' . $movieId .'?'. $this->token .'&language=en-US';
        $urlSimilar =  $this->baseUrl .'movie/' . $movieId .'/similar?'. $this->token .'&language=en-US';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $urlMovie);
        $resultMovie = json_decode(curl_exec($ch));

        curl_setopt($ch, CURLOPT_URL, $urlSimilar);
        $resultSimilar = json_decode(curl_exec($ch));
        
        $resultMovie->related = $resultSimilar;

        curl_close($ch);

        return response()->json($resultMovie, 200);

    }
    
}

<?php

namespace App\Http\Controllers;

use App\Article;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    public function addArticle(Request $request) {
        try {

            $topic = Topic::find($request->get("topic_id"));

            if( is_null($topic) ) {
                throw new \Exception("Topic not found");
            }

            $article = new Article();
            $article->topic_id = $request->get("topic_id");
            $article->title = $request->get("title");
            $article->body = $request->get("body");
            $article->slug = Str::slug($article->title);
            $article->save();

            $response = [
                "status" => true,
                "message" => "Article: $article->title successfully created",
                "value" => $article
            ];

        } catch (\Exception $ex) {
            $response = [
                "status" => false,
                "error" => $ex->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function updateArticle(Request $request, $id) {
//        try {
//
//
//
//            $response = [
//                "status" => true,
//                "message" => "Topic: $topic->topic_name updated to $topicName",
//                "value" => $topic
//            ];
//        } catch (\Exception $ex) {
//            $response = [
//                "status" => false,
//                "error" => $ex->getMessage()
//            ];
//        }
//
//        return response()->json($response);
    }

    public function getArticleList() {

        $topicList = Article::all();

        return response()->json([
            "status" => true,
            "message" => "All articles fetched",
            "value" => $topicList
        ]);
    }

    public function findArticleBySlug($slugArticle) {

        $article = Article::where("slug", $slugArticle)->first();

        return response()->json([
            "status" => true,
            "message" => "Article: $article->title successfully fetched",
            "value" => $article
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Article;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicsController extends Controller
{

    public function addTopic(Request $request) {
        try {

            $topic = new Topic();
            $topic->topic_name = $request->get("topic_name");
            $topic->slug = Str::slug($topic->topic_name);
            $topic->save();

            $response = [
                "status" => true,
                "message" => "Topic: $topic->topic_name successfully created",
                "value" => $topic
            ];

        } catch (\Exception $ex) {
            $response = [
                "status" => false,
                "error" => $ex->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function updateTopic(Request $request, $id) {
        try {

            $topic = Topic::find($id);

            // Before Update
            $topicName = $topic->topic_name;

            // After Update
            $topic->topic_name = $request->get("topic_name");
            $topic->slug = Str::slug($topic->topic_name);

            if( is_null($topic) ) {
                throw new \Exception("Topic not found");
            }

            $response = [
                "status" => true,
                "message" => "Topic: $topicName updated to $topic->topic_name",
                "value" => $topic
            ];
        } catch (\Exception $ex) {
            $response = [
                "status" => false,
                "error" => $ex->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function getTopicList() {

        $topicList = Topic::all();

        return response()->json([
            "status" => true,
            "message" => "All topics fetched",
            "value" => $topicList
        ]);
    }

    public function getArticleInTopics($slugTopic) {
        $topic = Topic::where("slug", $slugTopic)->first();

        $articleList = Article::where("topic_id", $topic->topic_id)->get();

        return response()->json([
            "status" => true,
            "message" => "All articles in $topic->topic_name fetched",
            "value" => $articleList
        ]);
    }

}

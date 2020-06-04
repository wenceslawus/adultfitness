<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Vimeo\Laravel\Facades\Vimeo;
use App\Models\user;

class uploadtest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:upload';
    protected $token = '7b8ddf409b07060d5aa31a0ea53428f5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle() {
      $url = 'https://localhost:8000/some?ticket_id=225898905&video_file_id=1309117147&signature=44fca9515bc8a2610295147af5a3a6ab&v6=1';
      $data = parse_url($url);
      parse_str($data['query'], $params);
      $point = explode("?", $url)[0];

      print_r([
        'point' => $point,
        'params'=> $params
      ]);
      exit;

      $path = '/videos/332436816?fields=privacy';
      //$video = Vimeo::request($path, [], 'GET');//*/

      //dd($video);

      $user = user::find(1);
      if($user->upload){
        // remove old uploader
        $upload = $user->upload;
        Vimeo::request("/videos/{$upload->video_id}",  [], 'DELETE');
        $upload->delete();
      }

      // create new uploader
      $response = Vimeo::request("/me/videos",  [], 'POST');
      if(isset($response['body'])) {
        $body = $response['body'];
        $params = explode('/', $body['uri']);
        if(isset($params[2]) && $params[2]) {
          $id = $params[2];
          $link = explode('&redirect_url', $body['upload']['upload_link']);
          $upload_link = $link[0];

          $user->upload()->create([
            'video_id' => $id,
            'upload_link' => $upload_link
          ]);

          // Update names
          Vimeo::request("/videos/$id", [
            'name' => "{$user->name} ({$user->email})",
            'description' => 'Uploaded by application',
            'privacy' => ['view' => 'unlisted'],
          ], 'PATCH');
        }
      }

      exit;



      echo "create new uploader\r\n";
      $path = '/me/videos?fields=uri,name,description';
      $result = Vimeo::request($path,  [], 'GET');
      //dd($result['body']['data'][0]);

      $path = '/videos/332403947';
      $result = Vimeo::request($path, [
        'name' => 'edit',
        'description' => 'by API',
        'privacy.view' => 'unlisted',
      ], 'PATCH');//*/

      $path = '/me/videos';
      $result = Vimeo::request($path, [], 'POST');
      echo (json_encode($result));
      exit;

      $myCurl = curl_init();
      curl_setopt($myCurl, CURLOPT_HTTPHEADER, [
        'Authorization: bearer ' . $this->token,
        'Content-Type: application/json',
        'Accept: application/vnd.vimeo.video;version=3.4'
      ]);

      curl_setopt_array($myCurl, array(
          CURLOPT_URL => 'https://api.vimeo.com/me/videos',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => http_build_query(array(/*здесь массив параметров запроса*/))
      ));
      $response = curl_exec($myCurl);
      curl_close($myCurl);
      echo "Ответ на Ваш запрос: ". $response;
      /*
      var xhr = new XMLHttpRequest()
      xhr.open(this.httpMethod, this.url, true)
      xhr.setRequestHeader('Authorization', 'Bearer ' + this.token)
      xhr.setRequestHeader('Content-Type', 'application/json')
      xhr.setRequestHeader('Accept', 'application/vnd.vimeo.video;version=3.4')

      xhr.onload = function(e) {
          // get vimeo upload  url, user (for available quote), ticket id and complete url
          if (e.target.status < 400) {
              var response = JSON.parse(e.target.responseText)
              this.url = response.upload.upload_link
              this.user = response.user
              //this.ticket_id = response.ticket_id
              this.complete_url = response.upload.upload_link
              this.sendFile_()
          } else {
              this.onUploadError_(e)
          }
      }.bind(this)

      xhr.onerror = this.onUploadError_.bind(this)
      xhr.send()//*/
    }
}

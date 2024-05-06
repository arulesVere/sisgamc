<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Google\Client;
use Google\Service\Drive;

use Auth;
use Alert;

class CGoogleDrive extends Controller
{
    public function index()
    {
        return view("GoogleDrive.index");
    }

    private function token()
    {
        $client_id = \Config('services.google.client_id');
        $client_secret = \Config('services.google.client_secret');
        $refresh_token = \Config('services.google.refresh_token');

        $response = Http::post('https://oauth2.googleapis.com/token', [

            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',

        ]);

        $access_token = json_decode((string) $response->getBody(), true)['access_token'];
        return $access_token;
    }

    public function uploadFile($name, $mime, $path, $folder_id, $driveService)
    {
        try {

            $fileMetadata = new Drive\DriveFile(
                array(
                    'name' => $name,
                    'parents' => array($folder_id)
                )
            );
            $content = file_get_contents($path);
            $file = $driveService->files->create(
                $fileMetadata,
                array(
                    'data' => $content,
                    'mimeType' => $mime,
                    'uploadType' => 'multipart',
                    'fields' => 'id'
                )
            );

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getFolderId($folderName, $driveService)
    {
        try {
            $files = array();
            $pageToken = null;

            $response = $driveService->files->listFiles(
                array(
                    'q' => "mimeType='application/vnd.google-apps.folder'",
                    'spaces' => 'drive',
                    'pageToken' => $pageToken,
                    'fields' => 'nextPageToken, files(id, name)',
                )
            );
            foreach ($response->files as $file) {
                if ($file->name == $folderName) {
                    return $file->id;
                }
            }

            $fileMetadata = new Drive\DriveFile(
                array(
                    'name' => $folderName,
                    'mimeType' => 'application/vnd.google-apps.folder'
                )
            );
            $file = $driveService->files->create(
                $fileMetadata,
                array(
                    'fields' => 'id'
                )
            );


            return $file->id;

        } catch (Exception $e) {
            echo "Error Message: " . $e;
        }
    }

    public function store(Request $request)
    {
        $name = $request->file_name;
        $mime = $request->file->getClientMimeType();
        $path = $request->file->getRealPath();
        $accessToken = $this->token();
        $folder_name = session('sessionusuario');

        $client = new Client();
        $client->setAccessToken($accessToken);
        $client->addScope(Drive::DRIVE);
        $driveService = new Drive($client);
        $folder_id = $this->getFolderId($folder_name, $driveService);

        $this->uploadFile($name, $mime, $path, $folder_id, $driveService);


        Alert::success('EXITO', 'RESPALDO EXITOSO');

        return view("GoogleDrive.index");
    }




}

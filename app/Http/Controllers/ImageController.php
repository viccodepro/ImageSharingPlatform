<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function getIndex()
    {
        //Let's load the form view
        return view('tpl.index');
    }

    /**
     * Method to process the image
     * @param Illuminate\Http\Request $request
     * @return response
     */
    public function postIndex(Request $request)
    {
        // Validate the form inputs with the rules created in the model
        $validation = Validator::make($request->all(), Photo::$upload_rules);
        // If validation failed redirect user to index page with error message
        if ($validation->fails()) {
            return redirect('/')->withInput()->withErrors($validation);
        } else {
            // If validation passed we upload the image to the database and process it
            // $image = $request->image;
            $image = $request->file('image');

            // dd($image);

            if ($image) {
                // This is the original uploaded client name of the image
                $filename = $image->getClientOriginalName();

                // using raw php for file extension
                $filename = pathinfo($filename, PATHINFO_FILENAME);
                $fullname = Str::slug('nsv' . Str::random(8) . $filename) . '.' . $image->getClientOriginalExtension();
                // dd(config('image.upload_folder'));

                $image_path_on_server = config('image.upload_folder') . '/' . $fullname;
                // dd($image_folder);

                $upload = $image->move(config('image.upload_folder'), $fullname);
                // Create a thumbnail from the uploaded image and save in thumbnail folder on server
                Image::make($image_path_on_server)->resize(config('image.thumb_width'), config('image.thumb_height'))->save(config('image.thumb_folder') . '/' . $fullname);
                if ($upload) {
                    // Retrieve the id of the column when data is inserted into the table
                    $insert_id = DB::table('photos')->insertGetId(array('title' => $request->title, 'image' => $fullname));
                    //Now we redirect to the image's permalink
                    return Redirect::to(URL::to('snatch/' . $insert_id))->with('success', 'Your image is uploaded successfully!');
                }
            }
        }
    }

    /**
     * Method to return image information
     * @param int $id
     */
    public function getSnatch($id)
    {
        $image = Photo::find($id);
        if ($image) {
            return view('tpl.permalink', ['image' => $image]);
        } else {
            redirect('/')->with('error', 'Image not found');
        }
    }

    /**
     * Method to return all images stored in database
     * @return array $images
     */
    public function getAll()
    {
        $images = DB::table('photos')->orderBy('id', 'desc')->paginate(4);
        return view('tpl.listings', ['images' => $images]);
    }

    /**
     * Method to delete the chosen image
     * @param int $id the id of the selected image
     */
    public function getDelete($id)
    {
        $image = Photo::find($id);
        // dd($image);
        if ($image) {
            // Delete the image from server
            // $deleted_from_server = Storage::delete([config('image.upload_folder').'/'.$image->image, config('image.thumb_folder').'/'.$image->image]);

                $deleted_from_server = File::delete([config('image.upload_folder').'/'.$image->image, config('image.thumb_folder').'/'.$image->image]);
            // dd($deleted_from_server);

            if ($deleted_from_server) {
                // If image is deleted from server, delete from database
                $image->delete();
                return redirect('/')->with('success', 'Image deleted successfully');
            } else {
                $delete_error = 'Image not deleted from server';
                return redirect('/')->with('error', $delete_error);
            }
        } else {
            return redirect('/')->with('error', 'No image with given ID found');
        }
    }
}

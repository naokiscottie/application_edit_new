<?php

namespace App\Http\Controllers;

use App\Http\Requests\PDF_Request;
use App\Models\Document;
use App\Models\Document_list;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class Document_uploadController extends Controller
{
    public function document_upload_form(){
        $company_member = Field::all();
        $document_lists = Document_list::all();
        return view ('document_upload',['company_member' => $company_member],['document_lists' => $document_lists]);
    }

    public function save_pdf (PDF_Request $request){

        $inputs = $request -> all();
        $document_name = $inputs['document_name'];
        $field_id = $inputs['field_id'];
        $document_id = $inputs['document_id'];
        $document_remarks = '';
        if($inputs['document_remarks'] != null){
            $document_remarks = $inputs['document_remarks'];
        }


        $cnt = count($request->file('post_pdf'));
        $randam_number = str_pad(mt_rand(0,99999999),8,0, STR_PAD_LEFT);
        $counter = 0;

        for($i=0; $i < $cnt ; $i++){

            $pdf_name = $randam_number.'_'.$i.'.'.$request->file('post_pdf')[$i]->extension();

            if($request->file('post_pdf')[$i]->extension() == 'pdf'){

                $request->file('post_pdf')[$i]->storeAs('public/test_2',$pdf_name);

                Document::create([
                    'file_name' => $pdf_name,
                    'document_name' => $document_name,
                    'field_id' => $field_id,
                    'document_id' => $document_id,
                    'document_remarks' => $document_remarks,
                ]);
                $counter = $counter +1;

            }

        }
        if($counter != 0){
            Session::flash('err_msg', 'pdfデータを登録しました。');
            return redirect ('/document_upload');
        }

        Session::flash('err_msg', 'pdfデータを登録できませんでした。');
        return redirect ('/document_upload');
    }

    public function Document_list(){

        $lists = DB::table('companys')->join('fields','fields.customer_id','=','companys.id')->get();
        return view('document_list')->with('lists',$lists);

    }

    public function Document_list_show($id){


        $documents = DB::table('documents')
        ->select('documents.id','documents.file_name','documents.document_name','documents.document_remarks','document_lists.document_name as document_category','documents.field_id')
        ->join('document_lists','documents.document_id','=','document_lists.id')
        ->where('field_id',$id)
        ->get();

        $documents  = $documents -> reverse();

        return view('document_show_page',['documents' => $documents]);

    }



    public function Document_delete($id,$id2){

        if(empty($id)){
            Session::flash('err_msg2','データがありません。');
            return redirect()->action([Document_uploadController::class, 'Document_list_show'], ['id' => $id2]);
        }


        $document = Document::where('id',$id)->get()->first();
        $del_path = storage_path().'/app/public/test_2/'.$document -> file_name;
        \File::delete($del_path);



        try{
        Document::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg2','データを削除しました。');
        return redirect()->action([Document_uploadController::class, 'Document_list_show'], ['id' => $id2]);

    }










}

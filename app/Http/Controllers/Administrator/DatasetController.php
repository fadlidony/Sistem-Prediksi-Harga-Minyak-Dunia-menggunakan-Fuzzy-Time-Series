<?php

namespace App\Http\Controllers\Administrator;

use Auth;
use Excel;
use App\Models\User;
use App\Models\Dataset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatasetController extends Controller
{
    public function index()
    {
      $data['user'] = User::find(Auth::user()->id);
      $data['dataset']= Dataset::all();
      return view('administrator.dataset',$data);
    }

    public function import(Request $request)
    {
      if ($request->excel->getClientOriginalExtension() !='xlsx') {
          return redirect(route('administrator.dataset'))->with('warning', 'Format berkas file tidak benar, file harus berformat .xlsx!');
      }
      Excel::load($request->file('excel'), function ($reader) {
          $reader->each(function ($sheet) {
            if (empty($sheet->tanggal) || empty($sheet->harga)) {
            }else {
              $data = Dataset::updateOrCreate(['tanggal' => $sheet->tanggal], ['harga' => $sheet->harga]);
            }
          });
      });
      return redirect(route('administrator.dataset'))->with('success', 'Import data berhasil!');
    }

    public function fuzzifikasi($dataset, $interval, $orde)
    {
      $i=0;
      foreach ($dataset as $key) {
        $y=0;
        if ($i>=$orde) {
            foreach ($interval as $key2) {
              if ( $key->harga >= $key2['bawah'] && $key->harga < $key2['atas']) {
                $fuzzyfikasi = $y;
              }
            $y++;
            }
          for ($n=0; $n < $orde; $n++) {
            $temp_orde['orde'.$n] = $data[$i-$orde+$n]['fuzzifikasi'];
          }
          $object = (object)($temp_orde);
          $data[$i]=['tanggal'=>$key->tanggal, 'harga'=>$key->harga, 'fuzzifikasi'=>$fuzzyfikasi,'orde'=>$object];

        }else{
          foreach ($interval as $key2) {
            if ( $key->harga >= $key2['bawah'] && $key->harga < $key2['atas']) {
              $fuzzyfikasi = $y;
            }
            $y++;
          }
        $data[$i]=['tanggal'=>$key->tanggal, 'harga'=>$key->harga, 'fuzzifikasi'=>$fuzzyfikasi,'orde'=>null];
        }
        $i++;
      }
      return $data;
    }

    public function model_lee($flr,$flrg)
    {
      $i=0;
      $hasil=[];
      foreach ($flrg as $key) {
        $temp=explode(",",$key);
        $z=0;
        foreach($temp as $link)
          {
            if($link == '')
            {
                unset($temp[$z]);
            }
            $z++;
          }
        $object = (object)($temp);
        $n=0;
        $hasil=[];
        foreach ($flr as $key2) {

          if (!is_null($key2['orde'])) {
            $temp_orde='';
          foreach ($key2['orde'] as $key3) {
            $temp_orde.=$key3.',';
            }
            if ($key==$temp_orde) {
              $hasil[$n]=$key2['fuzzifikasi'];
              $n++;
            }
          }
        }

        $hasil=array_count_values($hasil);

        $hasil_akhir = (object)($hasil);
        $lee[$i] = ['relasi'=>$object,'hasil'=>$hasil_akhir];
        $i++;
      }
      return $lee;
    }

    public function model_chen($flr,$flrg)
    {
      $i=0;
      $hasil=[];
      foreach ($flrg as $key) {
        $temp=explode(",",$key);
        $z=0;
        foreach($temp as $link)
          {
            if($link == '')
            {
                unset($temp[$z]);
            }
            $z++;
          }
        $object = (object)($temp);
        $n=0;
        $hasil=[];
        foreach ($flr as $key2) {

          if (!is_null($key2['orde'])) {
            $temp_orde='';
          foreach ($key2['orde'] as $key3) {
            $temp_orde.=$key3.',';
            }
            if ($key==$temp_orde) {
              $hasil[$n]=$key2['fuzzifikasi'];
              $n++;
            }
          }
        }

        $hasil=array_unique($hasil);
        asort($hasil);
        $temp_hasil = $hasil;
        $hasil=[];
        $x=0;
        foreach ($temp_hasil as $key) {
          $hasil[$x]=$key;
          $x++;
        }
        $hasil_akhir = (object)($hasil);
        $chen[$i] = ['relasi'=>$object,'hasil'=>$hasil_akhir];
        $i++;
      }
      return $chen;
    }

    public function flrg_chen($flr)
    {
      $i=0;
      foreach ($flr as $key) {
        $temp='';
        if (!is_null($key['orde'])) {
          foreach ($key['orde'] as $key2) {
            $temp.=$key2.',';
          }
          $flrg[$i]=$temp;
          $i++;
        }

      }
      $flrg=array_unique($flrg);
      asort($flrg);
      $temp = $flrg;
      $flrg = [];
      $i=0;
      foreach ($temp as $key) {
        $flrg[$i]=$key;
        $i++;
      }
      $hasil=$this->model_chen($flr,$flrg);
      return $hasil;
    }

    public function flrg_lee($flr)
    {
      $i=0;
      foreach ($flr as $key) {
        $temp='';
        if (!is_null($key['orde'])) {
          foreach ($key['orde'] as $key2) {
            $temp.=$key2.',';
          }
          $flrg[$i]=$temp;
          $i++;
        }

      }
      $flrg=array_unique($flrg);
      asort($flrg);
      $temp = $flrg;
      $flrg = [];
      $i=0;
      foreach ($temp as $key) {
        $flrg[$i]=$key;
        $i++;
      }
      $hasil=$this->model_lee($flr,$flrg);
      return $hasil;
    }


    public function defuzzifikasi_chen($flrg,$interval)
    {
      $n=0;
      foreach ($flrg as $key) {
        $relasi = $key['relasi'];
        $i=0;
        $temp=0;
        foreach ($key['hasil'] as $key2) {
          $temp+=$interval[$key2]['median'];
          $i++;
        }
        $ramalan=$temp/$i;
        $defuzzifikasi[$n]=['relasi'=>$key['relasi'],'hasil'=>$key['hasil'],'ramalan'=>$ramalan];
        $n++;
      }
      return $defuzzifikasi;
    }

    public function defuzzifikasi_lee($flrg,$interval)
    {
      $n=0;
      foreach ($flrg as $key) {
        $relasi = $key['relasi'];
        $i=0;
        $temp=0;
        foreach ($key['hasil'] as $key2 => $value) {
          for ($x=0; $x < $value; $x++) {
            $temp+=$interval[$key2]['median'];
            $i++;
          }
        }
        $ramalan=$temp/$i;
        $defuzzifikasi[$n]=['relasi'=>$key['relasi'],'hasil'=>$key['hasil'],'ramalan'=>$ramalan];
        $n++;
      }
      return $defuzzifikasi;
    }

    public function relasi($flr)
    {
      $i=0;
      foreach ($flr as $key) {
        $temp="";
        if (!is_null($key['orde'])) {
          foreach ($key['orde'] as $key2) {
            $temp.=$key2.",";
          }
        }else {
          $temp=null;
        }

        $relasi[$i]=['tanggal'=>$key['tanggal'], 'harga'=>$key['harga'], 'fuzzifikasi'=>$key['fuzzifikasi'],'orde'=>$key['orde'], 'relasi'=>$temp];
        $i++;
      }
      return $relasi;
    }


    public function relasi_defuzzifikasi($defuzzifikasi)
    {
      $i=0;
      foreach ($defuzzifikasi as $key) {
        $temp="";
        foreach ($key['relasi'] as $key2) {
          $temp.=$key2.",";
        }
        $relasi[$i]=['relasi'=>$temp, 'ramalan'=>$key['ramalan']];
        $i++;
      }
      return $relasi;
    }



    public function prediksi($flr,$defuzzifikasi)
    {
      $relasi=$this->relasi($flr);
      $relasi_deffuzifikasi=$this->relasi_defuzzifikasi($defuzzifikasi);
      $i=0;
      foreach ($relasi as $key) {
        if (!is_null($key['relasi'])) {
          foreach ($relasi_deffuzifikasi as $key2) {
            if ($key['relasi']==$key2['relasi']) {
              $prediksi[$i]=['tanggal'=>$key['tanggal'], 'harga'=>$key['harga'], 'fuzzifikasi'=>$key['fuzzifikasi'],'orde'=>$key['orde'], 'relasi'=>$key['relasi'],'ramalan'=>$key2['ramalan']];
            }
          }
        }else {
          $prediksi[$i]=['tanggal'=>$key['tanggal'], 'harga'=>$key['harga'], 'fuzzifikasi'=>$key['fuzzifikasi'],'orde'=>$key['orde'], 'relasi'=>$key['relasi'],'ramalan'=>null];
        }
        $i++;
      }
      return $prediksi;
    }

    public function kalkulasi_error($prediksi)
    {
      $i=0;
      foreach ($prediksi as $key) {
        if (!is_null($key['ramalan'])) {
          $absolute = abs($key['harga']-$key['ramalan']);
          $afer = $absolute/$key['harga'];
          $mse = pow($absolute,2);
        }else{
          $absolute = null;
          $afer = null;
          $mse =null;
        }
        $error[$i]=['absolute'=>$absolute,'afer'=>$afer,'mse'=>$mse,'tanggal'=>$key['tanggal'], 'harga'=>$key['harga'], 'fuzzifikasi'=>$key['fuzzifikasi'],'orde'=>$key['orde'], 'relasi'=>$key['relasi'],'ramalan'=>$key['ramalan']];
        $i++;
      }
      return $error;
    }

    public function mean_error($error)
    {
      $afer=0;
      $mse=0;
      $i=0;
      foreach ($error as $key) {
        if (!is_null($key['absolute'])) {
          $afer += $key['afer'];
          $mse += $key['mse'];
          $i++;
        }
      }

      $mean_afer=$afer/$i;
      $mean_mse=$mse/$i;
      $rmse = sqrt($mean_mse);
      $error = ['afer'=>$mean_afer,'mse'=> $mean_mse,'rmse'=>$rmse];
      return $error;
    }

    public function hasil_terbaik($chen, $lee)
    {
      if ($chen['afer']<$lee['afer']) {
        $model = "Chen";
        $akurasi = 100-(round($chen['afer']*100,2));
        $hasil =['model'=>$model,'akurasi'=>$akurasi];
      }elseif ($chen['afer']>$lee['afer']) {
        $model = "Lee";
        $akurasi = 100-(round($lee['afer']*100,2));
        $hasil =['model'=>$model,'akurasi'=>$akurasi];
      }else{
        $akurasi = 100-(round($lee['afer']*100,2));
        $hasil =['model'=>'sama', 'akurasi'=>$akurasi];
      }

      return $hasil;
    }

    public function hitung_get()
    {
      return redirect(route('administrator.dataset'));
    }

    public function hitung(Request $request)
    {
      $orde = $request->orde;
      $jumlah_data= Dataset::all()->count();
      $dataset=Dataset::all();
      if ($jumlah_data==0) {
        return redirect(route('administrator.dataset'))->with('warning', 'Dataset belum ada!');
      }
      $data['dataset'] = $dataset;
      $data['user'] = User::find(Auth::user()->id);
      $k=(int)round(1+3.3*log10($jumlah_data));
      $data['k']=$k;
      $max=Dataset::max('harga');
      $min=Dataset::min('harga');
      $interval=round(($max-$min)/$k,2);
      $data['lebar']=$interval;
      $i=0;
      $temp=$min;
      for ($i=0;$i<$k;$i++) {
        $bawah=$temp;
        $temp+=$interval;
        $data['interval'][$i] = ['bawah'=>$bawah,'atas'=>$temp,'median'=>($bawah+$temp)/2];
      }

      $data['flr']=$this->fuzzifikasi($dataset,$data['interval'],$orde);

      $data['orde']=$orde;
      $data['flrg_chen']=$this->flrg_chen($data['flr']);
      $data['flrg_lee']=$this->flrg_lee($data['flr']);
      $data['defuzzifikasi_chen']=$this->defuzzifikasi_chen($data['flrg_chen'],$data['interval']);
      $data['defuzzifikasi_lee']=$this->defuzzifikasi_lee($data['flrg_lee'],$data['interval']);
      $data['prediksi_chen']=$this->prediksi($data['flr'],$data['defuzzifikasi_chen']);
      $data['prediksi_lee']=$this->prediksi($data['flr'],$data['defuzzifikasi_lee']);
      $data['error_chen'] = $this->kalkulasi_error($data['prediksi_chen']);
      $data['error_lee'] = $this->kalkulasi_error($data['prediksi_lee']);
      $data['mean_lee'] = $this->mean_error($data['error_lee']);
      $data['mean_chen'] = $this->mean_error($data['error_chen']);
      $data['hasil'] = $this->hasil_terbaik($data['mean_chen'],$data['mean_lee']);

      return view('administrator.hasil',$data);
    }
}

@extends("master_archive")
@section('title_area')
    :: {{ $page_title }}  ::
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection

<style>
    .tableFixHead          { overflow-y: auto; height: 100px; }
    .tableFixHead thead th { position: sticky; top: 0; }

    /* Just common table stuff. Really. */
    table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px; }
    th     { background:#eee; }
</style>

@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>{{ $page_title }}</h2>

                <a href="{{ url('archive_book?type=1') }}" class="btn btn-primary btn-xs"
                   style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-book"></i>
                    আর্কাইভ খাতা
                </a>
            </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;">

                            <form class="form-inline" method="get"  action="">
                                <div class="form-group">
                                    <label for="email">স্ট্যটাস:</label>
                                    <select class="form-control" name="status">
                                        <option  value="">বাছাই করুন</option>
                                        <option {{ app('request')->input('status')=='0'?'selected':'' }} value="0">রিভিউ হয়নি</option>
                                        <option {{ app('request')->input('status') ? (app('request')->input('status')==2?'selected':'') :'' }} value="2">সংশোধন প্রয়োজন</option>
                                        <option {{ app('request')->input('status') ? (app('request')->input('status')==1?'selected':'') :'' }} value="1">আর্কাইভ হয়েছে</option>
                                    </select>
                                </div>
                                <div class="form-group">

                                    <label for="email">শুরুর তারিখ:</label>
                                    <input type="text" class="form-control datepickerLong" value="{{ app('request')->input('from_date') ? app('request')->input('from_date') :'' }}" autocomplete="off" placeholder="এন্ট্রি শুরুর তারিখ" name="from_date">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">শেষের তারিখ:</label>
                                    <input type="text" class="form-control datepickerLong" value="{{ app('request')->input('to_date') ? app('request')->input('to_date') :'' }}" autocomplete="off" placeholder="এন্ট্রি শেষের তারিখ" name="to_date">
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                            </form>

                            <br/>


                            <input type="hidden" id="playlist_id" name="playlist_id" value="<?php echo isset($active_playlist->playlist_id)?$active_playlist->playlist_id:'' ?>"/>
                            <input type="hidden" id="playlist_name" value="<?php  echo isset($active_playlist->name)?$active_playlist->name:'' ?>"/>
                            <audio style="margin-left:300px;" controls id="player">
                                <source id="audioSource" src="" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <table  class="tableFixHead  table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>কেন্দ্র</th>
                                    <th> নাম</th>
                                    <th>প্রথম লাইন</th>
                                    <th>প্রকার </th>
                                    <th> বেতার কেন্দ্র</th>
                                    <th>রিভিউ স্ট্যাটাস</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>সংরক্ষণকারী</th>
                                    <th>সংরক্ষণ টাইম</th>
                                    <th>File Name</th>
                                    <th style="width: 130px"> #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($archive_list)) {
                                foreach($archive_list as $row) {
                                    $song_info = json_decode($row->songit_info);
                                ?>
                                <tr>
                                <td>
                                    <?php echo $row->station_name ?>
                                </td>
                                <td>
                                    <?php echo !empty($song_info->name) ? $song_info->name :'' ?>
                                </td>
                                <td>
                                    <?php echo !empty($song_info->first_line) ? $song_info->first_line:'' ?>
                                </td>
                                <td>
                                    <?php
                                        if(!empty($song_info->category)) {
                                    $category_info =  get_name_by_id('archive_category',['id' =>$song_info->category]);
                                    echo $category_info->name;
                                    }
                                     ?>
                                </td>
                                
                                <td>
                                    <?php echo $row->sadin_bangla_betar ==0 ?'NO':'YES' ?>
                                </td>
                                <td style="font-weight:bold;color:<?php echo $row->is_approve ==0 ?'red':($row->is_approve ==2?'orange':'green') ?>">
                                    <?php if($row->is_approve ==0) {
                                        echo "রিভিউ হয়নি";
                                    }
                                    else if($row->is_approve ==2) { ?>
                                        <span data-toggle="modal" onclick="show_correction_message('<?php echo $row->correction_message ?>')" data-target="#correction_show_modal" style="cursor:pointer">সংশোধন</span>
                                    <?php
                                    }
                                    else {
                                    echo "আর্কাইভ হয়েছে";
                                    }
                                    ?>
                                </td>
                                <td style="font-weight:bold;color:<?php echo $row->status ==0?'red':'green'; ?>">
                                    <?php echo $row->status ==0 ?'ইন একটিভ':'একটিভ' ?>
                                </td>
                                <td><?php echo $row->emp_name; ?></td>
                                <td><?php echo date("Y-m-d H:i:a",strtotime($row->created_at)) ?></td>
                                <td>
                                    <?php echo !empty($row->file_name)?$row->file_name:'' ?>
                                </td>
                                <td>
                                    <?php if($row->is_approve!=1) { ?>
                                    <a href="javascript:void(0)" title="Edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                    <?php } ?>
                                    <a href="javascript:void(0)" title="Play" class="btn btn-primary btn-xs playbtn" id="<?php echo "btn".$row->id ?>"
                                            onClick="audioAction('{{ get_file_path($row->id) }}',<?php  echo $row->id; ?>);">
                                    <i class="fa fa-play"></i></a>
                                    <a title="View" class="btn btn-info btn-xs" href="{{ url('archive_item_view/'.$row->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ url('archive_item_download/'.$row->id) }}" title="Download" class="btn btn-success btn-xs">
                                        <i class="glyphicon glyphicon-download"></i>
                                    </a>
                                    <?php if($row->is_approve!=1) { ?>
                                    <a href="javascript:void(0)"  onclick="archive_item_delete(<?php echo $row->id; ?>)" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    <?php } ?>
                                </td>
                                </tr>
                                <?php 
                                }
                            }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

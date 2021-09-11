
@extends("master_archive")
@section('main_content_area')
    <style>
        #player {
            float:right;
            height:30px;
        }
    </style>
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <h2 class="no-print">{{ $page_title }}</h2>

            </header>
            <div>
                <div class="widget-body no-padding">

                    <div class="col-sm-12" style="margin-top:10px;">
                        <input type="hidden" id="playlist_id" name="playlist_id"
                               value="<?php echo isset($active_playlist->playlist_id) ? $active_playlist->playlist_id : '' ?>"/>
                        <input type="hidden" id="playlist_name"
                               value="<?php  echo isset($active_playlist->name) ? $active_playlist->name : '' ?>"/>
                    </div>

                    <div class="col-md-12">

                        <ul style="margin-top:10px" class="nav nav-tabs">
                            <li onclick="new_tab_url(1);" class="{{ !empty(app('request')->input('archive_type')) ? get_tab_active_class(1) : 'active'}}"><a data-toggle="tab" href="#home">সংগীত</a></li>
                            <li onclick="new_tab_url(2);" class="{{get_tab_active_class(2)}}"><a data-toggle="tab" href="#menu1">গল্প/কবিতা</a></li>
                            <li onclick="new_tab_url(3);" class="{{get_tab_active_class(3)}}"><a data-toggle="tab" href="#menu2">নাটক</a></li>
                            <li onclick="new_tab_url(4);" class="{{get_tab_active_class(4)}}"><a data-toggle="tab" href="#menu4">কম্পোজিট অনুষ্ঠান </a></li>
                            <li onclick="new_tab_url(5);" class="{{get_tab_active_class(5)}}"><a data-toggle="tab" href="#menu5">ভাষণ</a></li>
                            <li onclick="new_tab_url(6);" class="{{get_tab_active_class(6)}}"><a data-toggle="tab" href="#menu6">সাক্ষাৎকার</a></li>
                            <li onclick="new_tab_url(7);" class="{{get_tab_active_class(7)}}"><a data-toggle="tab" href="#menu7">কথিকা</a></li>
                            <li onclick="new_tab_url(8);" class="{{get_tab_active_class(8)}}"><a data-toggle="tab" href="#menu3">প্রচারণা</a></li>
                        </ul>

                        <?php
                        $archive_type = !empty(app('request')->input('archive_type')) ? app('request')->input('archive_type'):1;
                        ?>

                        <div class="tab-content">


                            <div id="home" class="{{ !empty(app('request')->input('archive_type')) ? get_tab_active_class(1) : 'active'}}">
                                @if($archive_type==1)
                                    @include('archive.archive_pages.songit',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>


                            <div id="menu1" class="tab-pane fade in {{get_tab_active_class(2)}}">
                                @if($archive_type==2)
                                    @include('archive.archive_pages.kobita',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>
                            <div id="menu2" class="tab-pane fade in {{get_tab_active_class(3)}}">
                                @if($archive_type==3)
                                    @include('archive.archive_pages.natok',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>

                            <div id="menu3" class="tab-pane fade in  {{get_tab_active_class(8)}}">
                                @if($archive_type==8)
                                    @include('archive.archive_pages.procharona',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>

                            <div id="menu4" class="tab-pane fade in {{get_tab_active_class(4)}}">
                                @if($archive_type==4)
                                    @include('archive.archive_pages.program',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>
                            <div id="menu5" class="tab-pane fade in {{get_tab_active_class(5)}}">
                                @if($archive_type==5)
                                    @include('archive.archive_pages.vhason',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>
                            <div id="menu6" class="tab-pane fade in {{get_tab_active_class(6)}}">
                                @if($archive_type==6)
                                    @include('archive.archive_pages.sakhhatkar',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>
                            <div id="menu7" class="tab-pane fade in {{get_tab_active_class(7)}}">
                                @if($archive_type==7)
                                    @include('archive.archive_pages.kothika',
                                    [
                                        'archive_list' => $archive_list,
                                        'station_info' => $station_info,
                                    ]
                                    )
                                @endif
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            </div>
        </div>
    </article>
    <script>
        function new_tab_url(id) {
            window.location.assign(window.location.pathname+'?archive_type='+id);
        }
        function print_report() {
           let  form=document.getElementById('searchPlanningInfoFrom');
            form.target='_blank';
            form.action= "<?php echo url('/archive_item_report') ?>";
            form.submit();
        }
        function submitForm() {
           let  form=document.getElementById('searchPlanningInfoFrom');
            // form.target='_blank';
            form.action= "<?php echo url('/archive_book') ?>";
            form.submit();
        }
    </script>
@endsection
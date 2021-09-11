@extends("master_program")
@section('main_content_area')
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header  >

                    <h2 class="no-print" >{{ $page_title }}</h2>
                    <a href="{{ url('program_magazine_create') }}" class="btn btn-info btn-xs no-print"
                       style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-list"></i>
                        পরিকল্পনা (Planning)
                    </a>
                    <a href="{{ url('program_proposal_khata') }}" class="btn btn-primary btn-xs no-print"
                       style="float:right;
                margin-top:5px;margin-right:5px;"><i class="glyphicon glyphicon-refresh"></i>
                        Refresh
                    </a>

             </header>
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        {!! Form::open(['url' => '', 'method' => 'post','id' => 'searchPlanningInfoFrom',
                'class'=>'form-horizontal']) !!}
                                <div class="form-group no-print" >

                                    <div class="col-md-2">
                                        <label> কেন্দ্রের / ইউনিট নাম </label>
                                        <select id="station_id"  required class="form-control" onchange="getSubStation(this.value)"  name="station_id">
                                            <option value="">চিহ্নিত করুন</option>
                                            @if(!empty($station_info))
                                                @foreach($station_info as $key=>$value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            @endif


                                        </select>

                                    </div>
                                    <div class="col-md-2">
                                        <label> ফ্রিকোয়েন্সি </label>
                                        <select id="sub_station_id" required class="form-control" name="fequency_id">
                                            <option value="">চিহ্নিত করুন</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label> শুরুর তারিখ </label>
                                        <input type="text" value="{{ date('01-m-Y')  }}" class="form-control
                                        datepicker"
                                               name="from_date">
                                    </div>


                                    <div class="col-md-2">
                                        <label > শেষ তারিখ </label>
                                        <input type="text" value="{{ date('d-m-Y')  }}"  class="form-control
                                        datepicker" name="to_date">
                                    </div>
                                    <div class="col-md-3">
                                        <label > অনুষ্ঠানের নাম </label>
                                        <select name="program_name"  class="select2" id="program_name">
                                            <option value="">চিহ্নিত করুন</option>
                                            @if(!empty($all_program_name))
                                                @foreach($all_program_name as $key=>$value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-1" style="margin-top:22px;">
                                        <button type="button" class="btn btn-success btn-sm"
                                                onclick="searchPlanningInfo()"
                                                name="search_proposal"
                                        ><i class="glyphicon glyphicon-search"></i> Search</button>
                                    </div>


                                </div>
                        {!! Form::close() !!}
                        <div id="form_output"></div>

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
@extends('layouts.panel')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">				
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Dashboard-->
			<div class="row">
        <div class="card card-custom bg-light-primary card-stretch gutter-b">
          <div class="card-body">
            <div class="col sidebar mb-3">
              <div class="list-group div-scroll">
                @foreach($folders as $folder)
                  <div class="list-group-item">
                    <a href="?f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}">
                      <span class="fa fa-folder"></span> {{$folder}}
                    </a>
                    @if ($current_folder == $folder)
                      <div class="list-group folder">
                        @foreach($folder_files as $file)
                          <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}&f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}"
                            class="list-group-item @if ($current_file == $file) llv-active @endif">
                            {{$file}}
                          </a>
                        @endforeach
                      </div>
                    @endif
                  </div>
                @endforeach
                @foreach($files as $file)
                  <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                    class="list-group-item @if ($current_file == $file) llv-active @endif">
                    {{$file}}
                  </a>
                @endforeach
              </div>
            </div>
            <div class="col-10 table-container">
              @if ($logs === null)
                <div>
                  Log file >50M, please download it.
                </div>
              @else
                <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}" style="font-size:11px;">
                  <thead>
                  <tr>
                    @if ($standardFormat)
                      <th>Level</th>
                      <th>Context</th>
                      <th>Date</th>
                    @else
                      <th>Line number</th>
                    @endif
                    <th>Content</th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach($logs as $key => $log)
                    <tr data-display="stack{{{$key}}}">
                      @if ($standardFormat)
                        <td class="nowrap text-{{{$log['level_class']}}}">
                          <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                        </td>
                        <td class="text">{{$log['context']}}</td>
                      @endif
                      <td class="date">{{{$log['date']}}}</td>
                      <td class="text">
                        
                        {{{$log['text']}}}
                        @if (isset($log['in_file']))
                          <br/>{{{$log['in_file']}}}
                        @endif
                        
                      </td>
                    </tr>
                  @endforeach

                  </tbody>
                </table>
              @endif
              <div class="p-3">
                @if($current_file)
                  <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                    <span class="fa fa-download"></span> Download file
                  </a>
                  -
                  <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                    <span class="fa fa-sync"></span> Clean file
                  </a>
                  -
                  <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                    <span class="fa fa-trash"></span> Delete file
                  </a>
                  @if(count($files) > 1)
                    -
                    <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                      <span class="fa fa-trash-alt"></span> Delete all files
                    </a>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
			</div>
			<!--end::Dashboard-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
@endsection

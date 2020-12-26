@if(isset($upload['fileType']) && !empty($upload['fileType']))
    @php $extDyanamic = true; @endphp
@else

    @php $upload['fileType'] = 'image'; @endphp
    @php $extDyanamic = false; @endphp
@endif
@if(isset($upload['upload_type']) && !empty($upload['upload_type']) && $upload['upload_type'] == 'multiple')
    @php $multipleUpload = true; @endphp
@else

    @php //$upload['fileType'] = 'image'; @endphp
    @php $multipleUpload = false; @endphp
@endif
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('resources/assets/backend/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('resources/assets/backend/js/uploader/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('resources/assets/backend/js/uploader/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('resources/assets/backend/js/uploader/jquery.fileupload.js')}}"></script>
<script src="{{asset('resources/assets/backend/js/uploader/jquery.fileupload-process.js')}}"></script>
<script src="{{asset('resources/assets/backend/js/uploader/jquery.fileupload-validate.js')}}"></script>
<script type="text/javascript">
    $(".fileUpload").fileupload({
        dataType: 'json',
        maxChunkSize: 1000000,
        add: function (e, data) {
            var domId=this.id;
            var extDyanamic = '{{$extDyanamic}}';
            var multipleUpload = '{{$multipleUpload}}';
            var fileId = domId;
            var uploadFiles = $('#'+fileId)[0];
            var upFile = uploadFiles.files[0];
            var uploadErrors = [];
            var ext=data.originalFiles[0]['type'].split('/')[1].toLowerCase();
            var maxSize="{{$upload['size']}}";
            var path = "{{$upload['path']}}";
            if(extDyanamic){
                var validFormat=<?php echo json_encode(getValidExtension($upload['fileType'])); ?>;
            }else{
                var validFormat=<?php echo json_encode(getValidExtension('image')); ?>;
            }
            if($.inArray(ext, validFormat) == -1) {
                uploadErrors.push('Not an accepted file type');
            }
            if (parseInt(data.originalFiles[0]['size']) > parseInt(maxSize)) {
                uploadErrors.push('Filesize is too big');
            }
            if (uploadErrors.length > 0) {
                $('#'+domId+'_file-error').html(uploadErrors.join("\n"));
            } else {
                $('#'+domId+'_file-error').html('');
                $('#'+domId+'FileName').text('Uploading...');
                $('#progress'+domId+'File').show();
                $('#'+domId+'Progress').show();
                $('#'+domId+'canceluploadBtn').html("<a href='javascript:void(0);' id='canceluploadlink' onclick=\"abort()\" style='color: #ff0000; margin-left: 10px;'><i class='fa fa-trash'></i></a>");
                $('#'+domId+'canceluploadBtn').show();
                //document.getElementById("canceluploadlink").onclick=function(){
                  //  jqXHR.abort();
                    //$('#progress'+domId+'File').hide();
                    //$('#'+domId+'canceluploadBtn').hide();
                    //$('#'+domId+'FileName').hide();
                    //var html = 'upload cancel by user';
                    //$('#'+domId+'_file-error').html(html);
               // };
                data.formData = [{name: '_token', value: '{{csrf_token()}}'}, {name:'opcode',value:'newUpload'},  {name:'path',value:path}, {name:'filed',value:fileId} , {name:'fileType',value:''}]
                var jqXHR =data.submit()
            }
        },
        progressall: function (e, data) {
            var domId=this.id;
            var fileId = domId;
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#'+domId+'Progress').css(
                'width', 
                progress + '%'
            );
        },
        done: function (e, data) {
            var domId=this.id;
            $('#progress'+domId+'File').hide();
            if (data.result.success == true) {
                var inputHidden = '';
                var multipleUpload = '{{$multipleUpload}}';
                if(multipleUpload == true){
                    $.each(data.result.uploadDetail, function (key, value) {
                        inputHidden+="<input type='hidden' name='"+domId+key+"'   value='"+value+"' >";
                    });
                }else{
                    $.each(data.result.uploadDetail, function (key, value) {
                        inputHidden+="<input type='hidden' name='"+key+"'   value='"+value+"' >";
                    });
                }
                var fileName = data.result.uploadDetail.fileName;
                $('#'+domId+'FormFieldDiv').html(inputHidden);
                var html = '';
                var htmlImg = '';
                html += data.result.uploadDetail.fileName;
                $('#'+domId+'FileName').show();
                $('#'+domId+'FileName').html(html);
                $('#'+domId+'ShowImg').attr('src', data.result.uploadDetail.location);
                var imgHtml = '<img src="'+data.result.uploadDetail.location+'"style="width: 50%;margin-top: 2%;margin-bottom: 2%;">';
                $('#'+domId+'Div').html(imgHtml);
            }
            if (data.result.success = false) {
                errorsHtml = '';
                $.each(data.result.errors, function (key, value) {
                    errorsHtml += '' + value[0] + '</br>'; //showing only the first error.
                });
                errorsHtml += '';
                $('#'+domId+'_file-error').html(errorsHtml);
            }
            $('#progress'+domId+'File').hide();
        }
    });

    $(".fileUploadMulti").fileupload({
        dataType: 'json',
        maxChunkSize: 1000000,
        add: function (e, data) {
            var domId=this.id;
            var fileId = domId;
            var uploadFiles = $('#'+fileId)[0];
            var upFile = uploadFiles.files[0];
            var uploadErrors = [];
            var ext=data.originalFiles[0]['type'].split('/')[1].toLowerCase();
            var maxSize="{{$upload['size']}}";
            var path = "{{$upload['path']}}";
            //var validFormat= {{$upload['format']}};
            var validFormat=<?php echo json_encode(getValidExtension('image')); ?>;
            console.log(validFormat);
            if($.inArray(ext, validFormat) == -1) {
                uploadErrors.push('Not an accepted file type');
            }
            if (parseInt(data.originalFiles[0]['size']) > parseInt(maxSize)) {
                uploadErrors.push('Filesize is too big');
            }
            if (uploadErrors.length > 0) {
                $('#'+domId+'_file-error').html(uploadErrors.join("\n"));
            } else {
                $('#'+domId+'_file-error').html('');
                $('#'+domId+'FileName').text('Uploading...');
                $('#progress'+domId+'File').show();
                $('#'+domId+'Progress').show();
                $('#'+domId+'canceluploadBtn').html("<a href='javascript:void(0);' id='canceluploadlink' onclick=\"abort()\" style='color: #ff0000; margin-left: 10px;'><i class='fa fa-trash'></i></a>");
                $('#'+domId+'canceluploadBtn').show();
                //document.getElementById("canceluploadlink").onclick=function(){
                  //  jqXHR.abort();
                    //$('#progress'+domId+'File').hide();
                    //$('#'+domId+'canceluploadBtn').hide();
                    //$('#'+domId+'FileName').hide();
                    //var html = 'upload cancel by user';
                    //$('#'+domId+'_file-error').html(html);
               // };
                data.formData = [{name: '_token', value: '{{csrf_token()}}'}, {name:'opcode',value:'newUpload'},  {name:'path',value:path}, {name:'filed',value:fileId} , {name:'fileType',value:''}]
                var jqXHR =data.submit()
            }
        },
        progressall: function (e, data) {
        var domId=this.id;
        var fileId = domId;
        var progress = parseInt(data.loaded / data.total * 100, 10);
        
        console.log();
            $('#'+domId+'Progress').css(
                'width', 
                progress + '%'
            );
        },
        done: function (e, data) {
            var domId=this.id;
            $('#progress'+domId+'File').hide();
            if (data.result.success == true) {
                var inputHidden = '';
                $.each(data.result.uploadDetail, function (key, value) {
                    inputHidden+="<input type='hidden' id='"+key+"' name='"+key+"'   value='"+value+"' >";
                });
                var fileName = data.result.uploadDetail.fileName;
                $('#'+domId+'FormFieldDiv').html(inputHidden);
                var html = '';
                var htmlImg = '';
                html += data.result.uploadDetail.fileName;
                htmlImg += data.result.uploadDetail.location; //console.log(htmlImg); 
                $('#'+domId+'FileName').show();
                $('#'+domId+'FileName').html(html);
                $('#'+domId+'ShowImg').attr('src', htmlImg);
            }
            if (data.result.success = false) {
                errorsHtml = '';
                $.each(data.result.errors, function (key, value) {
                    errorsHtml += '' + value[0] + '</br>'; //showing only the first error.
                });
                errorsHtml += '';
                $('#'+domId+'_file-error').html(errorsHtml);
            }
            $('#progress'+domId+'File').hide();
        }
    });
</script>
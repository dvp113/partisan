@extends('layouts.default')

@section('title', 'Dashboard Edge')

@section('content')
    <!-- Modal Edit Edge -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Edit Challenge </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">ID</label>
                            <input type="text" disabled class="form-control" id="edit_input_id">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Name</label>
                            <input type="text" class="form-control" id="edit_input_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">From</label>
                            <select id="edit_input_from" class="form-control">
                                <option selected></option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">To</label>
                            <select id="edit_input_to" class="form-control">
                                <option selected></option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Label</label>
                        <input type="text" class="form-control" id="edit_input_label">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">Color</label>
                            <input type="text" class="form-control" id="edit_input_color">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Font Align</label>
                            <input type="text" class="form-control" id="edit_input_font_align">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Font HMargin</label>
                            <input type="number" class="form-control" id="edit_input_font_hmargin">
                        </div>
                    </div>
                    -->
                    <div class="form-group">
                        <label for="id">id</label>
                        <input type="number" class="form-control" id="edit_input_id">
                    </div>
<div class="form-group">
                        <label for="title">title</label>
                        <input type="text" class="form-control" id="edit_input_title">
                    </div>
<div class="form-group">
                        <label for="description">description</label>
                        <input type="text" class="form-control" id="edit_input_description">
                    </div>
<div class="form-group">
                        <label for="max_score">max_score</label>
                        <input type="number" class="form-control" id="edit_input_max_score">
                    </div>

                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    <button type="button" class="btn btn-success" onClick="submitEdit()"><i class="fas fa-check-circle"></i>Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Edge -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Create New Edge </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Name</label>
                            <input type="text" class="form-control" id="create_input_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">From</label>
                            <select id="create_input_from" class="form-control">
                                <option selected></option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">To</label>
                            <select id="create_input_to" class="form-control">
                                <option selected></option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Label</label>
                        <input type="text" class="form-control" id="create_input_label">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">Color</label>
                            <input type="text" class="form-control" id="create_input_color">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Font Align</label>
                            <input type="text" class="form-control" id="create_input_font_align">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Font HMargin</label>
                            <input type="number" class="form-control" id="create_input_font_hmargin">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    <button type="button" class="btn btn-success" onClick="submitCreate()"><i class="fas fa-check-circle"></i>Save Edge</button>
                </div>
            </div>
        </div>
    </div>



    {{--<!-- Page Heading -->--}}
    {{--<h1 class="h3 mb-2 text-gray-800">Tables</h1>--}}
    {{--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>--}}

    <!-- DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary float-left">Challenge Managerment</h3>

            <button class="btn btn-primary float-right" onClick="create()"><i class="fas fa-plus"></i>&nbsp; New Challenge</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
<th>title</th>
<th>description</th>
<th>max_score</th>
<th>action</th>

                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script>

        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('challenge-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'description', name: 'description' },
{ data: 'max_score', name: 'max_score' },
{data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

        function reloadTable() {
            $("#dataTable").dataTable().fnDestroy();
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('challenge-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'description', name: 'description' },
{ data: 'max_score', name: 'max_score' },
{data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        }
        // create new record
        async function create() {
            nodes_data = await getAllNodeID();
            if (!nodes_data){
                alert("Cannot load data edges");
                return;
            }

            //add edge id to selection input
            $('#create_input_from').empty();
            $('#create_input_to').empty();
            $.each(nodes_data, function (i, id) {
                $('#create_input_from').append($('<option>', {
                    value: id,
                    text : id
                }));
                $('#create_input_to').append($('<option>', {
                    value: id,
                    text : id
                }));
            });

            //show model
            $('#createModal').modal();
        }

        //submit create
        function submitCreate() {
            //Prepare Data
            var create_data = {
                name        : $('#create_input_name').val(),
                label       : $('#create_input_label').val(),
                from        : $('#create_input_from').val(),
                to          : $('#create_input_to').val(),
                color       : $('#create_input_color').val(),
                font_align  : $('#create_input_font_align').val(),
                font_hmargin: $('#create_input_font_hmargin').val()
            };

            //Call ajax
            $.ajax({
                type: "POST",
                url: '/edge',
                data: create_data,
                dataType: 'text',
            })
                .done(function( msg ) {
                    console.log(msg)
                    if (msg == "success"){
                        $('#createModal').modal('hide');          //hide modal
                        alert("Create edge "+create_data['label']+" "+ msg);

                        //reload table
                        reloadTable();
                    }
                    else {
                        alert("Create edge "+create_data['label']+" "+ msg);
                    }
                });
        }

        // edit edge
        async function edit(element)
        {

            /*//Get data for model
            var value = $(element).parent().parent();
            var len = value.children().length;

            var data = [];
            for (i = 0; i < len; i++)
            {
                var value1 = value.children().eq(i).html();
                data.push(value1);
            }

            //Fill data to model
            var font_attr = JSON.parse(data[4]);
            var color = JSON.parse(data[6]);
            color = color["color"]? color["color"] : "";
            //add edge id to selection input
            $('#edit_input_from').empty();
            $('#edit_input_to').empty();
            $.each(nodes_data, function (i, id) {
                $('#edit_input_from').append($('<option>', {
                    value: id,
                    text : id
                }));
                $('#edit_input_to').append($('<option>', {
                    value: id,
                    text : id
                }));
            });

            $('#edit_input_id').val(data[0]);
            $('#edit_input_name').val(data[1]);
            $('#edit_input_from').val(data[2]);
            $('#edit_input_to').val(data[3]);
            $('#edit_input_font_align').val(font_attr['align']);
            $('#edit_input_font_hmargin').val(font_attr['hmargin']);
            $('#edit_input_label').val(data[5]);
            $('#edit_input_color').val(color);
            */
            //show model
            $('#editModal').modal();
        }

        //submit change edge
        function submitEdit() {
            //Prepare Data
            var id = $('#edit_input_id').val();
            var update_data = {
                name        : $('#edit_input_name').val(),
                label       : $('#edit_input_label').val(),
                from        : $('#edit_input_from').val(),
                to          : $('#edit_input_to').val(),
                color       : $('#edit_input_color').val(),
                font_align  : $('#edit_input_font_align').val(),
                font_hmargin: $('#edit_input_font_hmargin').val()
            };

            //Call ajax
            $.ajax({
                type: "PATCH",
                url: '/challenge/'+id,
                data: update_data,
                dataType: 'text',
            })
                .done(function( msg ) {

                    $('#editModal').modal('hide');          //hide modal
                    //reload table
                    reloadTable();
                });
        }

        //remove record
        function remove(element)
        {
            //Get data for model
            var value = $(element).parent().parent();
            var id = value.children().eq(0).html();

            //Call ajax
            $.ajax({
                type: "DELETE",
                url: '/challenge/'+ id,
                dataType: 'text',
            })
                .done(function( msg ) {
                    console.log(msg);

                    //reload table
                    reloadTable();
                });

        }
    </script>
@endsection
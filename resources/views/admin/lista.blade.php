@extends('admin.template')

@section('title', 'Lista Veículos')

@section('content')

    <div class="primaryMsgPage">
        Lista de Veículos armazenados no banco de dados
    </div>

    <div class="viewBy">
        <div class="list active">
            <img src="{{url('assets/images/list.png')}}"/>
        </div>
        <div class="card">
        <img src="{{url('assets/images/grid.png')}}"/>
        </div>
    </div>

    <div class="content__cars list"></div>
    <script type="text/javascript">
        $.ajax({
            url: "api/getAll",
            type: "GET",
            dataType: "json",
            data:{
                busca: $(this).prev().val()
            }
        }).done(function(c) {

            if( c["list"].length > 0 ){
                for( i = 0; i < c["list"].length; i++ ){
                    $(".content__cars").append('<a id="'+c["list"][i]["id"]+'" href="'+c["list"][i]["link"]+'" id-car="'+c["list"][i]["user_id"]+'"> <img src="'+c["list"][i]["img"]+'"/> <div class="data-car"> <span class="nome">'+c["list"][i]["nome_veiculo"]+'</span> <ul> <li> <span class="desc">Ano</span> <span class="value">'+c["list"][i]["ano"]+'</span> </li><li> <span class="desc">Quilometragem</span> <span class="value">'+c["list"][i]["quilometragem"]+'</span> </li><li> <span class="desc">Combustível</span> <span class="value">'+c["list"][i]["combustivel"]+'</span> </li><li> <span class="desc">Câmbio</span> <span class="value">'+c["list"][i]["cambio"]+'</span> </li><li> <span class="desc">Portas</span> <span class="value">'+c["list"][i]["portas"]+'</span> </li><li> <span class="desc">Cor</span> <span class="value">'+c["list"][i]["cor"]+'</span> </li></ul> </div><div class="price-car"> <div class=""> <span>Preço</span> <span class="price">'+c["list"][i]["preco"]+'</span> </div></div><div class="delete-car"> <span class="removeItem">Excluir</span> </div></a>');
                }
            }

            $(".removeItem").click(function(e){
                e.preventDefault();
                $(this).closest("[id]").remove();

                $.ajax({
                    url: "api/delete/"+$(this).closest("[id]").attr("id"),
                    type: "DELETE",
                    dataType: "json",
                }).done(function(c) {

                })
            })

        })
        $(".viewBy div").click(function(){
            if( !$(this).hasClass("active") ){
                $(".viewBy div").removeClass("active");
                $(this).addClass("active");
                viewBy = $(this).attr("class").split(" ")[0];

                $(".content__cars").attr("class", "content__cars "+viewBy);
            }
        })
    </script>

@endsection
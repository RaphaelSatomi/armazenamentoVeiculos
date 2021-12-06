@extends('admin.template')

@section('title', 'Home')

@section('content')

    <div class="primaryMsgPage">
        Adicionar lista de carros baseado na busca do termo
    </div>
    <div class="content__buscaTermo">
        <form>
            <input type="text" name="busca" placeholder="Ex: Audi"/>
            <input type="submit" value="Buscar"/>
        </form>
        <div class="msgText">
            <div class="lds-ring"><div></div></div>
            <span class="successMsg"></span>
            <span class="errorMsg"></span>
        </div>
    </div>
    <div class="viewBy" style="display: none">
        <span class="listDb">
            Veículos retornados na sua busca
        </span>
        <div class="list active">
            <img src="{{url('assets/images/list.png')}}"/>
        </div>
        <div class="card">
        <img src="{{url('assets/images/grid.png')}}"/>
        </div>
    </div>
    <div class="content__cars"></div>
    <script type="text/javascript">
        $(".content__buscaTermo input[type='submit']").click(function(e){
            e.preventDefault();
            $(".content__buscaTermo").addClass("loading");
            $(".viewBy").hide();
            $(".msgText span").hide();
            $(".msgText").removeClass("finish");
            $(".content__cars a").remove();

            $.ajax({
                url: "api/add",
                type: "POST",
                dataType: "json",
                data:{
                    busca: $(this).prev().val()
                }
            }).done(function(c) {
                $(".content__buscaTermo").removeClass("loading");

                console.log(c);
                if( c["error"] == ""){
                    $(".successMsg").text(c["msg"]);
                    $(".successMsg").show();
                    $(".viewBy").show();
                }else{
                    $(".errorMsg").text(c["error"]);
                    $(".errorMsg").show();
                }
                $(".msgText").addClass("finish");

                if( c["list"].length > 0 ){
                    for( i = 0; i < c["list"].length; i++ ){
                        $(".content__cars").append('<a href="'+c["list"][i]["link"]+'" id-car="'+c["list"][i]["user_id"]+'"> <img src="'+c["list"][i]["img"]+'"/> <div class="data-car"> <span class="nome">'+c["list"][i]["nome_veiculo"]+'</span> <ul> <li> <span class="desc">Ano</span> <span class="value">'+c["list"][i]["ano"]+'</span> </li><li> <span class="desc">Quilometragem</span> <span class="value">'+c["list"][i]["quilometragem"]+'</span> </li><li> <span class="desc">Combustível</span> <span class="value">'+c["list"][i]["combustivel"]+'</span> </li><li> <span class="desc">Câmbio</span> <span class="value">'+c["list"][i]["cambio"]+'</span> </li><li> <span class="desc">Portas</span> <span class="value">'+c["list"][i]["portas"]+'</span> </li><li> <span class="desc">Cor</span> <span class="value">'+c["list"][i]["cor"]+'</span> </li></ul> </div><div class="price-car"> <div class=""> <span>Preço</span> <span class="price">'+c["list"][i]["price"]+'</span> </div></div></a>');
                    }
                }
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
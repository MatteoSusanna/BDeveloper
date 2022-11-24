<template>
    <div>
        <div class="my_jumbo mb-5"> <!-- mettere opacity non mi ricordo come si fa!!!!! -->
            <div class="op">
                <div class="my_title">
                    <h1 class="display-3"> {BC} <span>ode</span></h1>
                    <p class="lead">Il Primo sito dove puoi cercare, contattare e recensire qualsiasi sviluppatore per ogni tua esigenza!</p>
                    <hr class="my_hr">
                    <h2 class="display-4">E' semplice!</h2>
                    <p class="lead">Cerchi lo Sviluppatore più adatto alle tue esigenze, Lo contatti, E IL CODICE È FATTO!</p>
                    
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default {
  name: "MyJumbo",
  data(){
    return{
      authUser: window.authUser
    }
  },
};
</script>

<style lang="scss">
.my_hr{
    border: solid 2px rgb(94, 228, 28);
}

.my_jumbo{
    position: relative;
    background-color: #000000;
    box-shadow: 0.5rem 0.25rem 0.25rem #2d362c;
    height: 500px;

    &:before{
    background-image:url('../../../public/img/jumbo.gif') ;
    background-size: cover;
    content: ' ';
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 0.4;
    background-repeat: no-repeat;
    background-position: 50% 0;
    background-size: cover;
    }
    .my_title{
    position: absolute;
    color: white;
    text-shadow: 2px 2px #000000;
    padding: 30px;
    top: 50%;
    transform: translate(0,-50%);
    h1{
     color: rgb(94, 228, 28);  
     span{
        color: white;
     } 
    }
    p{
        font-size: 30px;
    }
}
}




</style>

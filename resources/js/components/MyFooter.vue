<template>
    <div>
        <div class="my_footer">

            <div class="my_title">
                <h1 class="display-4"> {BC} <span>ode</span></h1>
                <hr class="my_hr_footer">
                <div class="d-flex justify-content-center my_link">
                    <div>
                        <span class="display-4">I nostri social</span>
                        <ul class="my_ul">
                            <li>
                                <a href=""><i class="fa-brands fa-twitter fa-2x mr-2"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa-brands fa-square-facebook fa-2x mr-2"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa-brands fa-linkedin fa-2x mr-2"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa-brands fa-github fa-2x mr-2"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa-solid fa-hippo fa-2x mr-2"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="text-white text-center">Copyrights - 2022 BDeveloper by Simone - Matteo - Francesco - Giacomo . All rights reserved</p> 
            </div>

        </div>
    </div>
</template>

<script>

export default {
  name: "MyFooter",
  data(){
    return{
      authUser: window.authUser
    }
  },
};
</script>

<style lang="scss">


.my_footer{
    background-color: rgb(39, 39, 39);



    .my_title{
    color: white;
    text-shadow: 2px 2px #000000;
    padding: 30px;
        p{
            font-size: 20px;
            margin-top: 10px;
        }
        h1{
        color: rgb(94, 228, 28);  
        span{
            color: white;
        } 
        }
    }
    .my_link{
        .my_ul{
            display: flex;
            justify-content: center;
        }
        ul{
            li{
                list-style: none;
                a{
                    text-decoration: none;
                }
            }
        }
    }
}

.my_hr_footer{
    border: solid 1px rgb(94, 228, 28);
}


</style>
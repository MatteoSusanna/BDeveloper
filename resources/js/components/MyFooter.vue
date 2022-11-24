<template>
    <div>
        <div class="my_footer">

            <div class="my_title">
                <h1 class="display-4"> {BC} <span>ode</span></h1>
                <hr class="my_hr_footer">
                <div class="d-flex justify-content-around my_link">
                    <div>
                        <span>I nostri social</span>
                        <ul>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <span>I nostri link</span>
                        <ul>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <span>Contattaci</span>
                        <ul>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                            <li>
                                <a href="">instagram</a>
                            </li>
                        </ul>
                    </div>
                </div>
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
}

.my_hr_footer{
    border: solid 1px rgb(94, 228, 28);
}

.my_link{
    ul{
        li{
            list-style: none;
            a{
                text-decoration: none;
            }
        }
    }
}
</style>
<template>
    <div class="container-fluid my_header mb-3">

        <div class="container d-flex justify-content-between align-items-center">
          <div>
            <a href="/">
              <img src="/img/logo.jpeg" class="img-fluid w-25">
            </a>
          </div>

            <div class="d-flex align-items-center">
                <div v-if="!authUser">
                    <a class="p-3 link" href="/login">Login</a>
                    <a class="p-3 link" href="/register">Registrati</a>
                </div>

                <div v-else>
                    <a class="p-3 profile-container" href="/admin">
                        <div class="text-center">
                            <i class=" fas fa-user"></i>
                            <div>{{ authUser.name }} {{ authUser.lastname }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
  name: "MyAppHeader",
  data(){
    return{
      authUser: window.authUser
    }
  },
};
</script>

<style lang="scss">
  .my_header{
    background-color: #141913;
    box-shadow: 0.5rem 0.25rem 0.25rem #2d362c;
    width: 100%;

    

    .link {
      color: #95f50f;
      font-size: 20px;
    }

    .profile-container {
      font-size: 20px;
      text-decoration: none;
      color: #95f50f;
    }

}
</style>

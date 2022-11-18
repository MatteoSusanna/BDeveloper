<template>
    <div class="container container-single-dev">

        <div class="d-flex justify-content-between">

            <div class="d-flex">
                
                <div class="img-container rounded-circle overflow-hidden ">
                    <img :src="developer.cover" class="img-fluid" >
                </div>

                <div class="ml-5 info-container">
                    <h1>{{developer.name}} {{developer.lastname}}</h1>
                    <h4>Specialization:</h4>
                    <div class="d-flex flex-wrap box-container">
                        <div class="mr-2 mb-3 box" v-for="(specialization, index) in developer.specialization" :key="index">{{specialization.name}}</div>
                    </div>
                    <h4>Skill:</h4>
                    <div class="d-flex flex-wrap box-container">
                        <div class="mr-2 mb-2 box" v-for="(skill, index) in developer.skill" :key="index">{{skill.name}}</div>
                    </div>
                    <div class="mt-4">
                        <h4>Email: {{developer.email}}</h4>
                        <h4>Tel: {{developer.phone}}</h4>
                        <h4>Indirizzo: {{developer.address}}</h4>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <h3>C.V.</h3>
                        <a v-if="developer.curriculum != 'http://127.0.0.1:8000/img/no-file.png'" :href="developer.curriculum" target="_blank">
                            <img src="http://127.0.0.1:8000/img/pdf.png" class="img-fluid">
                        </a>
                        <h5 v-else class="ml-3">Curriculum non caricato</h5>
                    </div>
                </div>
            </div>


            <div class="message-container p-5 text-center">
                <h2>Contattami</h2>
                <!-- form invio messaggio sviluppatore -->
                <form @submit.prevent="sendMessage()">
                    <!-- Contenuto nome -->
                    <div class="form-group">
                        <label for="nome">Nome</label>

                        <input type="text" class="form-control input input-text" :class="(errors.name)?'is-invalid':''" id="nome" v-model="name" required placeholder="Scrivi il tuo nome">

                        <div class="invalid-feedback" v-for="(error, index) in errors.name" :key="index">
                            {{error}}
                        </div>
                    </div>

                    <!-- Contenuto cognome -->
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        
                        <input type="text" class="form-control input input-text" :class="(errors.lastname)?'is-invalid':''" id="cognome" v-model="lastname" required placeholder="Scrivi il tuo cognome">

                        <div class="invalid-feedback" v-for="(error, index) in errors.lastname" :key="index">
                            {{error}}
                        </div>
                    </div>

                    <!-- Contenuto email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        
                        <input type="email" class="form-control input" :class="(errors.email)?'is-invalid':''" id="email" v-model="email" required placeholder="Scrivi la tua email">

                        <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
                            {{error}}
                        </div>
                    </div>

                    <!-- Contenuto Messaggio -->
                    <div class="form-group">
                        <label for="messaggio">Messaggio</label>
                        <textarea class="form-control input" :class="(errors.text)?'is-invalid':''" id="messaggio" rows="6" v-model="text" required placeholder="Scrivi il tuo messaggio per lo sviluppatore"></textarea>

                        <div class="invalid-feedback" v-for="(error, index) in errors.text" :key="index">
                            {{error}}
                        </div>
                    </div>

                    <!-- Bottone invio messaggio -->
                    <button class="btn btn-primary my-3" type="button" disabled v-if="(disabledButton)">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Invio
                    </button>

                    <button v-else type="submit" class="btn btn-single-dev my-3">Invia messaggio</button>

                    <!-- In caso messaggio inviato con successo -->
                    <div class="alert alert-success my_alert" role="alert" v-if="statusMessage">
                        <i class="fa-solid fa-circle-check"></i> <h4>Messaggio inviato con successo!</h4>
                    </div>
                </form>
            </div>

        </div>


        <div class="review-container p-5 mb-5 text-center">
            <h2 class="mb-5">Lascia una recensione</h2>
            <!-- form invio recensione sviluppatore -->
            <form @submit.prevent="sendReview()">

                <div class="d-flex">
                    <!-- Contenuto nome -->
                    <div class="form-group mr-5">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control input input-text" :class="(errors.nome)?'is-invalid':''" id="nome" v-model="nome" required placeholder="Scrivi il tuo nome">

                        <div class="invalid-feedback" v-for="(error, index) in errors.nome" :key="index">
                            {{error}}
                        </div>
                    </div>

                    <!-- Contenuto cognome -->
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        <input type="text" class="form-control input input-text" :class="(errors.cognome)?'is-invalid':''" id="cognome" v-model="cognome" required placeholder="Scrivi il tuo cognome">

                        <div class="invalid-feedback" v-for="(error, index) in errors.cognome" :key="index">
                            {{error}}
                        </div>
                    </div>
                </div>

                <!-- Contenuto Messaggio -->
                <div class="form-group">
                    <label for="messaggio">Messaggio</label>
                    <textarea class="form-control" :class="(errors.messaggio)?'is-invalid':''" id="messaggio" rows="6" v-model="messaggio" required placeholder="Scrivi la recensione per lo sviluppatore"></textarea>

                    <div class="invalid-feedback" v-for="(error, index) in errors.messaggio" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Voto Recensione -->
                <div class="form-group">
                    <label for="inputState">Voto da 1 a 5</label>
                    <select id="inputState" class="form-control input" v-model="voto" :class="(errors.voto)?'is-invalid':''">
                        <option selected disabled>Scegli il tuo voto da 1 a 5</option>
                        <option value="1" required>1</option>
                        <option value="2" required>2</option>
                        <option value="3" required>3</option>
                        <option value="4" required>4</option>
                        <option value="5" required>5</option>
                    </select>

                    <div class="invalid-feedback" v-for="(error, index) in errors.voto" :key="index">
                        {{error}}
                    </div>
                </div>

                <!-- Bottone invio  -->
                <button class="btn btn-primary my-3" type="button" disabled v-if="(disabledButtonRew)">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Invio
                </button>

                <button v-else type="submit" class="btn btn-single-dev my-3">Invia Recensione</button>

                 <!-- In caso recensione inviata con successo -->
                <div class="alert alert-success my_alert" role="alert" v-if="statusReview">
                    <i class="fa-solid fa-circle-check"></i> <h3>Recensione inviata con successo!</h3>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center">
            <a href="/" class="btn btn-single-dev my-3">Torna alla Home</a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SingleDev',
    data(){
        return{
            //messaggio
            name: '',
            lastname: '',
            email: '',
            text: '',
            //recensione
            nome: '',
            cognome: '',
            messaggio: '',
            voto: '',

            developer: null,
            idDev: '',
            errors: {},
            statusMessage: false,
            statusReview: false,
            disabledButton: false,
            disabledButtonRew: false,
            authUser: window.authUser
        }
    },
    methods:{
        //invia messaggio
        sendMessage(){
            this.disabledButton = true;
            axios.post('/api/message', {
                    'name': this.name,
                    'lastname': this.lastname,
                    'email': this.email,
                    'text': this.text,
                    'user_id': this.idDev,
                }).then(res =>{
                    this.statusMessage = res.data.status;
                    this.disabledButton = false;

                    if(this.statusMessage){
                        this.error = {};
                        this.name = '';
                        this.lastname = '';
                        this.email = '';
                        this.text = '';
                    }else{
                        this.errors = res.data.error;
                    }

                });
        },
        //invia recensione
        sendReview(){
            this.disabledButtonRew = true;
            axios.post('/api/review', {
                    'nome': this.nome,
                    'cognome': this.cognome,
                    'messaggio': this.messaggio,
                    'voto': this.voto,
                    'user_id': this.idDev,
                }).then(res =>{
                    this.statusReview = res.data.status;
                    this.disabledButtonRew = false;

                    if(this.statusReview){
                        this.error = {};
                        this.nome = '';
                        this.cognome = '';
                        this.messaggio = '';
                        this.voto = '';
                    }else{
                        this.errors = res.data.error;
                    }

                });
        }
    },
    mounted(){
        let slug = this.$route.params.slug;

            axios.get('/api/developer/' + slug)
            .then(res =>{
                this.developer = res.data.result
                this.idDev = res.data.result.id
                console.log(res.data.result)
            })

        if (authUser) {
            this.name = this.authUser.name;
            this.lastname = this.authUser.lastname;
            this.email = this.authUser.email;
        }

    }
}
</script>

<style lang="scss">
.container-single-dev {
    margin-top: 80px;
    margin-bottom: 80px;

    .img-container {
        width: 200px;
        height: 200px;
    }

    .box-container {
        max-width: 300px;
    }

    .box {
        min-width: 50px;
        min-height: 40px;
        background-color: #141913;
        border-radius: 5px;
        color: #95f50f;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        padding: 0 4px 0 4px;
    }

    .message-container {
        border: 2px solid #141913;
        border-radius: 10px;
        padding-top: 40px;
        padding-bottom: 40px;

        .my_alert {
            width:100%;
            margin:10px auto;
            padding:15px;
            border-radius:5px;
            background-color: #a8f0c6;
            border-left:5px solid green;

            .fa-solid {
                font-size: 18px;
            }
        }
    }

    .btn-single-dev {
        background-color: #141913;
        color: #95f50f;
        font-size: 20px;

        &:hover {
            background-color: #090908;
            box-shadow: 0.15rem 0.15rem 0.25rem #31372c;
            color: #95f50f;
        }

    }

    .input {
        width: 300px;
    }

    .input-text {
        text-transform: capitalize;
    }

    label {
        font-size: 20px;
    }

    .review-container {
        margin-top: 60px;
        border: 2px solid #141913;
        border-radius: 10px;

        .my_alert {
            width:100%;
            margin:10px auto;
            padding:15px;
            border-radius:5px;
            background-color: #a8f0c6;
            border-left:5px solid green;

            .fa-solid {
                font-size: 18px;
            }
        }
    }
}


</style>

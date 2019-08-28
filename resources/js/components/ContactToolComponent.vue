<template>
    <div class="d-flex flex-column">
        <div v-for="inf in info">
            <p v-if="inf.active" v-html="inf.content"></p>
        </div>

        <div class="container p-2">
            <div class="interactiveBar">
                <div class="d-flex flex-row">
                    <div class="col-xs-6">
                        <a href="tel:0633873411">06 33 87 34 11</a>
                    </div>
                    <div class="col-xs-2">
                        <img src="img/menu/Map.svg" alt="adresse" v-on:click="enable" class="map-icon icon">
                    </div>
                    <div class="col-xs-2">
                        <img src="img/menu/Email.svg" alt="Email" class="enveloppe-icon icon" v-on:click="enable">
                    </div>
                    <div class="col-xs-2">
                        <img src="img/menu/Flag-EN.svg" alt="choix langue" v-on:click="enable" class="flag-icon flag">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        monted() {
            console.log('component mounted')
        },
        data () {
            return {
                info: [
                    {active: true,content: '<div class="adresse "><p>254 Chemin de la Farèle</p><p>83500 La Seyne Sur Mer</p></div>'},
                    {active: false, content:'<div class="email "><p>quentin.gaubert@wanadoo.fr</p></div>'},
                    {active: false, content: '<div class="langue "><a href="#"><img class="contryFlag flag" src="img/menu/Flag-FR.svg" alt="Drapeau Francais"></a><a href="#"><img class="contryFlag flag" src="img/menu/Flag-EN.svg" alt="Drapeau Anglais"></a></div>'}
                    ]
            }
        },
        methods: {
            enable: function(event) {
                let min = event.target.className;
                if (min.indexOf('map') >= 0) {
                    this.info[0].active = true;
                } else {
                    this.info[0].active = false;
                }

                if (min.indexOf('enveloppe') >=  0) {
                    this.info[1].active = true;
                } else {
                    this.info[1].active = false;
                }

                if (min.indexOf('flag') >= 0) {
                    this.info[2].active = true;
                } else {
                    this.info[2].active = false;
                }

            }
        }
    }
</script>

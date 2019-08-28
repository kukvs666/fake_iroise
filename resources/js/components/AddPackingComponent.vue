<template>
    <div class="container-add-packing-component py-5">
        <div class="is-menu" v-show="isMenu">
            <div v-show="packingListe.length > 0" class="added-packing-liste">
                <div v-for="value in packingListe">
                    <p class="value-format"> {{ value.format }} </p>
                </div>
            </div>
            <div v-on:click="switchface" class="packing-add-button">
                <button type="button" class="packing-add-button">+ Ajouter un packing</button>
            </div>
        </div>
        <div class="not-menu" v-show="!isMenu">
            <packing-component :packing-data="to_packing" v-on:send-packing="packing_added"></packing-component>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('add packing component mounted')
        },
        props: ["packingData"],
        data: function () {
            return {
                packingListe: [],
                isMenu: true,
                packings_output: {}
            }
        },
        computed: {
            // Je n'ai pas besoin de donnée extérieur pour le fonctionement
            // de ce composant, je transmet donc directement les donnée recu
            to_packing: function () {
                return this.packingData;
            },

        },
        methods: {


            // --------------------------------------------
            // ----------   INTERNAL FONCTION   -----------
            // --------------------------------------------


            packing_added: function (data) {
                this.isMenu = true;
                if (Object.entries(data).length > 0) {
                    data["format"] = this.format_packing(data);
                    this.packingListe.push(data);
                    this.packings_output.packings = this.packingListe;
                    this.sendPackings();
                }
            },

            switchface: function () {
                this.isMenu = false;
            },

            sendPackings: function () {
                console.log('sendpakings signal');
                this.$emit('send-packings', this.packings_output);
            },


            // ----------------------------------------
            // ----------   FROM TEMPLATE   -----------
            // ----------------------------------------


            activate: function (event, select_ref) {
                this.$parent.activate(event, select_ref);
            },


            // --------------------------------------------
            // ------------   FORMATING DATA   ------------
            // --------------------------------------------


            format_packing: function(data) {
                let listWords = data.calibre.type.replace(/\.\.\./g, '').split(/\s+/);
                let str_calibre = '';
                if (listWords.length === 3) {
                    str_calibre = listWords[0] + ' ' + data.calibre.min + ' ' + listWords[1] + ' ' + data.calibre.max + ' ' + listWords[2] + ' : ';
                } else if (listWords.length === 2) {
                    str_calibre = listWords[0] + ' ' + data.calibre.base + ' ' + listWords[1] + ' : ';
                } else {
                    str_calibre = data.calibre["desc-calibre"] + ' : ';
                }
                let final_str = str_calibre + data.price + ' € ' + data.sell_unit.unit;
                return final_str;
            }

        },
    }
</script>

<style>
    .container-add-packing-component {
        width: 100%;
        display: flex;
        flex-direction: column;
        margin: auto;
    }
    .packing-add-button {
        width: 350px;
        height: 100px;
        background-color: #F3E9E9;
        font-size: 30px;
        color: #AEA1A1;
    }
    .added-packing-liste, .packing-add-button, .is-menu {
        margin: auto;
    }
    .value-format {
        font-size: 1.5em;
        color: black;
        background-color: #C4C4C4;
        font-weight: bold;
    }
</style>

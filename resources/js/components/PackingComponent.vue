<template>
     <div class="container-packing-component py-5">
        <div class="form-group">
            <label for="sell_unit_select">Choisir l'unité : </label>
            <select class="form-control" id="sell_unit_select" name="sell_unit_set" v-on:change="activate($event, sell_unit, 'sell_unit')">
                <option value="0">-- Choisir une unité de vente --</option>
                <option v-for="value in sell_unit" :value="value.id">{{ value.unit }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price_set">Prix :</label>
            <input class="form-control" id="price_set" type="number" name="price_set" :placeholder="price" step="0.1" v-on:change="updatePrice">
        </div>
        <div class="form-group">
            <label for="gabarit_set">Type de gabarit :</label>
            <select class="form-control" id="gabarit_set" name="gabarit_set" v-on:change="activate($event, calibre, 'calibre')">
                <option value="0">-- Choisir gabarit --</option>
                <option v-for="value in calibre" :value="value.id" >{{ value.type }}</option>
            </select>
        </div>
        <div v-for="value in calibre">
            <div  v-if="value.active"><v-runtime-template v-bind:template="value.template" /></v-runtime-template></div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-success" v-on:click="valide">Valider</button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-danger" v-on:click="cancel">Annuler</button>
        </div>
    </div>
</template>

<script>
import VRuntimeTemplate from "v-runtime-template";
    export default {
        mounted() {
            console.log('component mounted')
        },
        props: ["packingData"],
        data: function () {
            return {
                calibre: this.packingData.calibre,
                price: this.packingData.price,
                sell_unit: this.packingData.sell_unit,
                valide_data: {sell_unit: false, calibre: false, price: false, calibre_values: false},
                valide_calibre_values: {},
                packing_output: {}
            }
        },
        // Composant nécéssaire pour me permettre de lier les évenements
        // du HTML contenu dans des variables.
        components: {
            VRuntimeTemplate
        },
        methods: {


            // -------------------------------------------------
            // ----------    FROM HTML IN VARIABLE    ----------
            // -------------------------------------------------


            getValue: function (event, cible) {
                if (event.target.validity.valid) {
                    this.valide_calibre_values[cible] = true;
                }
                for (let value of this.calibre) {
                    if (value.active) {
                        if (isNaN(parseInt(event.target.value))) {
                            value[cible] = event.target.value;
                        } else {
                            value[cible] = parseInt(event.target.value, 10);
                        }
                    }
                }
            },


            // ----------------------------------------------
            // ------------    FROM TEMPLATE    -------------
            // ----------------------------------------------


            activate: function (event, select_ref, key_data) {
                if (event.target.value > 0) {
                    this.valide_data[key_data] = event.target.validity.valid;
                }
                this.$parent.activate(event, select_ref);
            },

            updatePrice: function (event) {
                this.price = parseInt(event.target.value);
                if (this.price > 0) {
                    this.valide_data.price = true;
                }

            },

            cancel: function () {
                this.sendPacking();
            },

            valide: function () {
                this.validate();
            },


            // ----------------------------------------------
            // ----------    INTERNAL FUNCTION    -----------
            // ----------------------------------------------


            resetActif: function () {
                document.querySelector('#sell_unit_select').value = "0";
                document.querySelector('#gabarit_set').value = "0";
                document.querySelector('#price_set').value = 0
                for (let value of this.calibre) {
                    value.active = false;
                }
                for (let value of this.sell_unit) {
                    value.active = false;
                }

                for (let data of Object.keys(this.valide_data)) {
                    this.valide_data[data] = false;
                }
                this.valide_calibre_values = {};
            },

            sendPacking: function () {
                this.$emit('send-packing', this.packing_output);
                this.resetActif();
                this.packing_output = {};
            },


            // ---------------------------------------------------
            // -------------   VALID AND PACK DATA   -------------
            // ---------------------------------------------------


            validate: function () {
                if (this.check_values()) {
                    this.valide_data.calibre_values = true;
                }
                let flag = true;
                for (let value of Object.values(this.valide_data)) {
                    if (!value) {
                        flag = false;
                    }
                }

                if (flag === true) {
                    this.bundlePacking();
                } else {
                    alert("Les informations ne sont pas complètes");
                }

            },

            check_values: function () {
                let mykeys = [["min", "max"],["base"],["desc-calibre"]];
                let values = Object.keys(this.valide_calibre_values).sort().toString();
                for (let key of mykeys) {
                    if (values === key.sort().toString()) {
                        return true;
                    }
                }
            },

            bundlePacking: function () {
                for ( let value of this.sell_unit) {
                    if (value.active) {
                        this.packing_output.sell_unit = value;
                    }
                }
                for (let value of this.calibre) {
                    if (value.active) {
                        this.packing_output.calibre = value;
                    }
                }
                if (this.price > 0) {
                    this.packing_output.price = this.price;
                    this.valide_data.price = true;
                }
                this.sendPacking();
            },

        }


    }
</script>

<style>
    .container-packing-component {
        width: 50vw;
        background-color: #F0DDDD;
        padding: 60px;
    }
    .test3 {
        width: 30vw;
        margin: auto;
    }
    .form-control {
        min-width: 0px;
    }
</style>

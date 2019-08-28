<template>
    <form id="form-product-component">
        <div class="container-product-component py-5">
            <div class="products-dropdown">
                <div class="form-group">
                    <label for="product_select">Choisir le produit : </label>
                    <select class="form-control" id="product_select" name="product_set" v-on:change="activate($event, product, 'product')">
                        <option value="0">-- Choisir un produit --</option>
                        <option v-for="value in product" :value="value.id">{{ value.nameProduct }}</option>
                   </select>
                </div>
                <div class="form-group">
                    <label for="teaser_select">Choisir le teaser : </label>
                    <select class="form-control" id="teaser_select" name="teaser_set" v-on:change="activate($event, teaser, 'teaser')">
                        <option value="0">-- Choisir un teaser --</option>
                        <option v-for="value in teaser" :value="value.id">{{ value.content }}</option>
                    </select>
                </div>
            </div>
            <add-packing-component :packing-data="to_add_packing" v-on:send-packings="packings_maj"></add-packing-component>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-success" v-on:click="valide">Valider</button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-danger" v-on:click="cancel">Annuler</button>
        </div>

    </form>
</template>

<script>
    export default {
        mounted() {
            console.log('product component mounted');
        },
        props: ["packingData"],
        data: function () {
            return {
                // On récupère les donnée depuis AddProductComponent
                price: this.packingData.price,
                calibre: this.packingData.calibre,
                sell_unit: this.packingData.sell_unit,
                product: this.packingData.product,
                teaser: this.packingData.teaser,
                valide_data: {"product": false, "teaser": false, "packings": false},
                product_output: {},
                isMenu: true
            }
        },
        computed: {
            // Je rassemble les données pour les transmettre à AddPackingComponent
            // je ne transmet cette fois que 3 donnée
            to_add_packing: function () {
                return {"price": this.price, "calibre": this.calibre, "sell_unit": this.sell_unit}
            }
        },
        methods: {


            // -------------------------------------------
            // ----------   INTERNAL FUNCTION   ----------
            // -------------------------------------------


            packings_maj: function (data) {
                if (data.packings) {
                    this.product_output.packings = data.packings;
                    this.valide_data.packings = true;
                }
            },

            sendProduct: function () {
                this.$emit('send-product', this.product_output);
                this.product_output = {};
                this.reset();
            },

            reset: function () {
                document.querySelector('#product_select').value = "0";
                document.querySelector('#teaser_select').value = "0";
                this.$children[0]._data.packingListe = [];

                for (let value of this.product) {
                    value.active = false;
                }
                for (let value of this.teaser) {
                    value.active = false;
                }

                for (let data of Object.keys(this.valide_data)) {
                    this.valide_data[data] = false;
                }


            },



            // -------------------------------------------
            // -----------   FROM TEMPLATE   -------------
            // -------------------------------------------


            activate: function (event, select_ref, key_data) {
                if (event.target.value > 0) {
                    this.valide_data[key_data] = event.target.validity.valid;
                }

                for (let i of select_ref) {
                    if (parseInt(event.target.value, 10) === i.id) {
                        i.active = true;
                    } else {
                        i.active = false;
                    }
                }
            },

            valide: function () {
                this.validate();
            },

            cancel: function () {
                this.product_output = {};
                this.sendProduct();
            },


            // ---------------------------------------------
            // ----------   VALID AND PACK DATA   ----------
            // ---------------------------------------------


            validate: function () {
                let flag = true;
                for (let value of Object.values(this.valide_data)) {
                    if (!value) {
                        flag = false;
                    }
                }

                if (flag === true) {
                    this.bundleProduct();
                } else {
                    alert("les information ne sont pas complète")
                }


            },

            bundleProduct: function () {
                for (let value of this.product) {
                    if (value.active) {
                        this.product_output.product = value;
                    }
                }
                for (let value of this.teaser) {
                    if (value.active) {
                        this.product_output.teaser = value;
                    }
                }
                this.sendProduct();
            },
        },
    }
</script>

<style>
    #form-product-component {
        width: 50vw;
        padding: 20px;
    }
    add-packing-component {
    }
    .container-product-component {
        display: flex;
        flex-direction: column;
    }
</style>

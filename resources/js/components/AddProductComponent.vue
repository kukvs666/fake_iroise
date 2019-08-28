<template>
    <div class="container-add-product-component py-5">
        <div class="is-list" v-show="isList">
            <div v-show="productsListe.length > 0" class="added-products-liste">
                <div v-for="value in productsListe">
                    <p class="value-format" v-for="packing in value.packings"> {{ value.product.nameProduct }}, {{ packing.format }} </p>
                    <img src="img/Poisson.png" alt="image"></br>
                    <p class="value-format"> {{ value.teaser.content }} </p>
                </div>
            </div>
            <div v-on:click="switchface" class="product-add-button">
                <button type="button" class="product-add-button">+ Ajouter un produit</button>
            </div>
        </div>
        <div class="not-list" v-show="!isList">
            <product-component :packing-data="to_product" v-on:send-product="product_added"></product-component>
        </div>
        <div v-show="productsListe.length > 0 && isList">
            <button type="button" class="btn btn-success" v-on:click="valide">Valider</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('add product component mounted');
        },
        props: ["inData"],
        data: function () {
            return {
                // Ici on récupère les données passé en attribut à app-product-component
                // C'est un JSON en provenant de mon contrôleur PHP.
                //
                // Je parse le JSON pour disposer de cinq objets JS que je peut transmettre
                price: JSON.parse(this.inData).price,
                calibre: JSON.parse(this.inData).calibre,
                sell_unit: JSON.parse(this.inData).sell_unit,
                product: JSON.parse(this.inData).products,
                teaser: JSON.parse(this.inData).teaser,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                products: {},
                productsListe: [],
                isList: true
            }
        },
        computed: {
            // Fonction qui rassemble les cinq objet en un seul à transmettre aux enfants
            to_product: function () {
                return {"price": this.price, "calibre": this.calibre, "sell_unit": this.sell_unit, "product": this.product, "teaser": this.teaser}
            },
        },
        methods: {


            // --------------------------------------------
            // ----------   INTERNAL FUNCTION   -----------
            // --------------------------------------------


            product_added: function (data) {
                this.isList = true;
                if (Object.entries(data).length > 0) {
                    this.productsListe.push(data);
                }
            },

            switchface: function () {
                this.isList = false;
            },

            sendProducts: function () {
                let httpHeader = {'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf};
                let myheader = new Headers(httpHeader);
                let init = {
                    'method': 'POST',
                    'headers': myheader,
                    'body': JSON.stringify(this.products)
                };

                fetch('/mjml', init)
                .then(function(res) {
                    console.log('ok on passe par là');
                    console.log(res.status);
                    console.log(res);
                })
                .catch(function(error) {
                    console.log('My god, il y as eu un problème :' + error.message);
                });

            },

            // ------------------------------------------
            // -----------   FROM TEMPLATE   ------------
            // ------------------------------------------


            valide: function () {
                if (this.productsListe.length > 0) {
                    let compteur = 0;
                    for (let value of this.productsListe) {
                        this.products[compteur] = value;
                        compteur++;
                    }
                    this.sendProducts();
                } else {
                    alert("Attention, il n'y as aucun produit dans la liste");
                }
            },
        },
    }
</script>

<style>
    .product-add-button {
        width: 350px;
        height: 100px;
        background-color: #F3E9E9;
        font-size: 30px;
        color: #AEA1A1;
        }

</style>

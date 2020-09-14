<template>
<v-container>
  <v-data-table
    :headers="headers"
    :items="produits"
    sort-by="titre"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title> Les Produits de Partenaires (Vendeurs) </v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical 
        ></v-divider>
      </v-toolbar>
    </template>
    <template v-slot:no-data>
      <v-btn color="#00adb5" @click="initialize()">Reset</v-btn>
    </template>
  </v-data-table>
</v-container>
</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      headers : [
       {text:'Titre',align :'left',value:'titre'},
       {text:'Description',align :'left',value:'description',sortable: false},
       {text:'Prix(DA)',align :'left',value:'prix'},
       {text:'Marque',align :'left',value:'marque',sortable: false},
       {text:'Quantité',align :'left' , value:'quantite',sortable: false},
       {text:'Couleur',align :'left' , value:'couleur',sortable: false},
       {text:'Poids(Kg)',align :'left' , value:'poids'},
       {text:'Longueur(m)',align :'left' , value:'longueur'},
       {text:'Largeur(m)',align :'left' , value:'largeur'},
       {text:'Hauteur(m)',align :'left' , value:'hauteur'},
     ] ,
      produits: [],
      dialog:false,
      index:-1,
      defaultItem: {
        titre:"",
        description:"",
        prix:0,
        marque:"",
        quantite:0,
        couleur:"",
        poids:0.0,
        longueur:0.0,
        largeur:0.0,
        hauteur:0.0,
      },
    }),
    created () {
      this.initialize();
    },
    methods: {
      initialize () {
          let obj = this;
          axios.get(`http://127.0.0.1:8000/api/produit`)
          .then(function (response) {
            obj.produits = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
    },
  }
</script>

<style scoped>

</style>
<template>
<v-container>
  <v-data-table
    :headers="headers"
    :items="livraisons"
    sort-by="nom"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title> Les Livraisons (Le Client a confirmé ça commande ) </v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical 
        ></v-divider>
        <v-spacer></v-spacer>
          <v-dialog light v-model="dialog" max-width="850px">
          <template>
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-show="false"
            ></v-btn>
          </template>
          <v-card>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <v-card-title>
                <h2> Détails de la livraison </h2>
            </v-card-title>
            <v-card-text v-if="dialog">
                <v-card outlined v-for="(produit,i) in produits" :key="i">
                    <v-card-text>
                        <h1> Produit {{i+1}} </h1>
                    <v-row>
                        <v-col md="6" align="start">
                            <h5> - <strong> Nom Produit </strong>  : {{produit.titre}}</h5>
                            <h5> - <strong> Marque </strong>  : {{produit.marque}}  </h5>
                            <h5> - <strong> Prix </strong>  : {{produit.prix}} DA </h5>
                            <h5> - <strong> Prix Livraison </strong> : {{produit.prix}} DA </h5>
                            <h5> - <strong> Description </strong> : {{produit.description}} </h5>
                        </v-col>
                            <v-divider
                                class="mx-4"
                                vertical
                            ></v-divider>
                        <v-col md="4">
                            <h6> - <strong> Poids </strong>  : {{produit.poids}} ( kilogrammes ) </h6>
                            <h6> - <strong> Couleur </strong>  : {{produit.couleur}}  </h6>
                            <h6> - <strong> Longueur </strong>  : {{produit.longueur}} ( mètres ) </h6>
                            <h6> - <strong> Largeur </strong> : {{produit.largeur}} ( mètres ) </h6>
                            <h6> - <strong> Hauteur </strong> : {{produit.hauteur}} ( mètres ) </h6>
                        </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="fermer()" > Fermer </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>   
    <v-dialog light v-model="dialog1" max-width="500px">
          <template>
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-show="false"
            ></v-btn>
          </template>
          <v-card>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <v-card-text>
                <h3> Modifier l'état de la livraison </h3>
                <v-select
                        :items="etats"
                        v-model="etat"
                        label="Etat de la commande"
                        outlined
                        color="#11999e"
                ></v-select>
            </v-card-text>
            <v-card-actions>
               <v-row>
                <v-col md="6" align="center">
                    <v-btn color="grey" text @click="fermer()"> Annuler</v-btn>
                </v-col>
                <v-col md="6" align="center">
                    <v-btn color="#11999e" text @click="save()">Sauvegarder</v-btn>
                </v-col>
                </v-row>
            </v-card-actions>
          </v-card>
        </v-dialog>  
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        medium
        @click="detailsItem(item)"
        color="primary"
      >
        mdi-clipboard-text
      </v-icon>
      <v-icon
        medium
        @click="editItem(item)"
        color="#00adb5"
      >
        mdi-pencil
      </v-icon>
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
       {text:'Nom',align :'left',value:'nom'},
       {text:'Prénom',align :'left',value:'prenom'},
       {text:'Téléphone',align :'left',value:'numero',sortable: false},
       {text:'Région',align :'left' , value:'region'},
       {text:'Ville',align :'left' , value:'ville'},
       {text:'Adresse',align :'left' , value:'adresse',sortable: false},
       {text:'Etat de la commande',align :'left' , value:'etat',sortable: false},      
       {text: 'Actions',align :'center', value: 'actions', sortable: false}
     ] ,
      livraisons: [],
      dialog:false,
      dialog1:false,
      index:-1,
      done:false,
      etat:"",
      produits : [] ,
      etats:[
          "Commande passee",
          "Confirmation",
          "Preparation",
          "Expedition et Livraison",
          "Commande livree", 
      ],
    }),
    created () {
      this.initialize();
    },
    methods: {
      initialize () {
          let obj = this;
          axios.get(`http://127.0.0.1:8000/api/livraison`)
          .then(function (response) {
            obj.livraisons = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
      detailsItem (item) {
        this.index = this.livraisons.indexOf(item);
        let obj = this;
        axios.get(`http://127.0.0.1:8000/api/livraison/show/${obj.livraisons[obj.index].id}`)
        .then(function (response) {
          obj.produits = response.data.data ;
          console.log(obj.produits);  
        })
        .catch(function (error) {  
          console.log(error);
        });
        obj.dialog = true ;
      },
      fermer(){
        this.dialog = false ;
        this.dialog1  = false;
        this.index = -1;
        this.produits = [];
      },
      editItem(item){
        this.index = this.livraisons.indexOf(item);
        this.etat = this.livraisons[this.index].etat;
        this.dialog1 = true ;   
      },
      save(){
        let obj = this;
        axios.patch(`http://127.0.0.1:8000/api/livraison/update/${obj.livraisons[obj.index].id}`,{
            etat:obj.etat
        })
        .then(function (response) {
          obj.produits = response.data.data ;
          obj.livraisons[obj.index] = obj.etat;
          console.log(obj.produits);  
        })
        .catch(function (error) {  
          console.log(error);
        });
        this.fermer();  
      }
    },
  }
</script>

<style scoped>

</style>
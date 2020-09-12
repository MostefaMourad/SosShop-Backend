<template>
<v-container> <!--
  <v-data-table
    :headers="headers"
    :items="reponses"
    sort-by="commentaire"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title>Les Reponses </v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
            <v-dialog light v-model="dialog" max-width="300px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
              v-show="false"
            ></v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline"> Supprimer l'Avis ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez une réponse.
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="#00adb5" text @click="close">Annuler</v-btn>
              <v-btn color="red" text @click="save">Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog> 
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        medium
        @click="deleteItem(item)"
        color="red"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="#00adb5" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table> -->
</v-container>
</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      headers : [
       {text:'Commentaire',align :'left',value:'commentaire'},
       {text:'Likes',align :'left',value:'likes'},
       {text:'Utilisateur',align :'left' , value:'user'},
       {text:'Avis',align :'left',value:'avis'},
       {text: 'Actions',align :'center', value: 'actions', sortable: false}
     ] ,
      reponses: [],
      dialog:false,
      defaultItem: {
        commentaire:"",
        likes:0,
        user:"",
        avis:""
      },
    }),
    created () {
     // this.initialize()
    },

    methods: {
      
    },
  }
</script>
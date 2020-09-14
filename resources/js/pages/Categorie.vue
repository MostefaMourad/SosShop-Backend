<template>
  <v-data-table
    :headers="headers"
    :items="categories"
    sort-by="nom"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title> Mes Catégories </v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="450px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="#11999e"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            > Ajouter une catégorie </v-btn>
          </template>
          <v-card light>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-text-field color="#11999e" outlined  v-model="editedItem.nom" label="Nom Catégorie"></v-text-field>
            </v-card-text>

            <v-card-actions>
                <v-row>
                  <v-col md="6" align="center">
                       <v-btn color="grey" text @click="close"> Annuler</v-btn>
                  </v-col>
                  <v-col md="6" align="center">
                       <v-btn color="#11999e" text @click="save">Sauvegarder</v-btn>
                  </v-col>
                </v-row>
            </v-card-actions>
          </v-card>
        </v-dialog>
         <v-dialog light v-model="dialog1" max-width="350px">
          <template>
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-show="false"
            ></v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline"> Supprimer la Catégorie ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez la catégorie , ainsi, tout les produits associées seront également supprimées .
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="close()" >Annuler</v-btn>
              <v-btn color="red" text @click="del()" >Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog> 
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        medium
        class="mr-2"
        color="#11999e"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        medium
        color="red"
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="#11999e" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>

<script>
import axios from 'axios'

  export default {
    data: () => ({
      dialog: false,
      dialog1:false,
      headers: [
        {
          text: 'Nom de la Catégorie',
          align: 'start',
          value: 'nom',
        },
        { text: 'Nombre de Produit dans la catégorie', value: 'nombre_produits'},
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      categories: [],
      editedIndex: -1,
      editedItem: {
        nom: '',
        nombre_produits: 0,
      },
      defaultItem: {
        nom: '',
        nombre_produits: 0,
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nouvelle Catégorie' : 'Modifier la Catégorie'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
          let obj = this;
          axios.get(`http://127.0.0.1:8000/api/categorie`)
          .then(function (response) {
            obj.categories = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },

      editItem (item) {
        this.editedIndex = this.categories.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog = true;
      },

      deleteItem (item) {
        this.editedIndex = this.categories.indexOf(item);
        this.dialog1 = true;
      },

      close () {
        this.dialog = false;
        this.dialog1 = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        })
      },
      save () {
        let obj = this ;
        if (this.editedIndex > -1) {
          axios.patch(`http://127.0.0.1:8000/api/categorie/update/${obj.categories[obj.editedIndex].id}`,{nom:obj.editedItem.nom})
          .then(function (response) {
            obj.categories[obj.editedIndex].nom = obj.editedItem.nom;
            console.log(obj.categories[obj.editedIndex].nom);
          })
          .catch(function (error) {    
            console.log(error);
          });
        } else {
          if(obj.editedItem.nom!=null){
            axios.post(`http://127.0.0.1:8000/api/categorie/store`,{nom:obj.editedItem.nom})
            .then(function (response) {
              obj.categories.push(response.data.data);
              console.log(response.data);
            })
            .catch(function (error) {    
              console.log(error.response.data.errors);
            });
          }
          }
        this.close()
      },
      del(){
        let obj = this;
        axios.delete(`http://127.0.0.1:8000/api/categorie/delete/${obj.categories[obj.editedIndex].id}`)
        .then(function (response) {
          console.log(response.data);
          obj.categories.splice(obj.editedIndex, 1);
        })
        .catch(function (error) {  
        console.log(error);
        });
        this.close()
      }
    },
  }
</script>
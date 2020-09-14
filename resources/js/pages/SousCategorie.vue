<template>

  <v-data-table
    :headers="headers"
    :items="souscategories"
    sort-by="nom"
    class="elevation-1"
  >

    <template v-slot:top>

      <v-toolbar flat>

        <v-toolbar-title> Mes Sous-Catégories </v-toolbar-title>

        <v-divider
          class="mx-4"
          inset
          vertical
        >

        </v-divider>

        <v-spacer></v-spacer>

        <v-dialog v-model="dialog" max-width="450px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="#11999e"
              dark
              class="mb-2" 
              v-bind="attrs"
              v-on="on" 
            > Ajouter une sous-catégorie </v-btn>
          </template>

          <v-card light>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-text-field color="#11999e" outlined  v-model="editedItem.nom" label="Nom Sous-Catégorie"></v-text-field>
              
              <v-select
                :items="dataCat"
                v-model="editedItem.categorie"
                label="Catégorie"
                outlined
                color="#11999e"
                v-show="editedIndex < 0"
              ></v-select>

              <v-file-input
                color="#11999e"
                v-model="editedItem.image"
                accept="image/png, image/jpeg, image/bmp"
                placeholder="Choisir une photo"
                prepend-icon="mdi-camera"
                label="Photo de la sous-catégorie"
                v-show="editedIndex < 0"
              ></v-file-input>
            </v-card-text>
            <v-row>
              <v-col md="6" align="center">
                    <v-btn color="grey" text @click="close"> Annuler</v-btn>
              </v-col>
              <v-col md="6" align="center">
                    <v-btn color="#11999e" text @click="save">Sauvegarder</v-btn>
              </v-col>
            </v-row>
          </v-card>
        </v-dialog>

        <v-dialog light v-model="dialog1" max-width="400px">
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
              <span class="headline"> Supprimer la Sous-Catégorie ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez la sous-catégorie , ainsi, tout les produits associées seront également supprimées .
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="close()" >Annuler</v-btn>
              <v-btn color="red" text @click="del()" >Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <v-dialog light v-model="dialog2" max-width="400px">
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
              <span class="headline"> La Banière de la sous-catégorie </span>
            </v-card-title>
            <v-card-text>
              <img :src="imageUrl" alt="Profile Photo">
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="close()" > Fermer </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        medium
        color="primary"
        @click="viewImage(item)"
      >
        mdi-image-area
      </v-icon>
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
      dialog2:false,
      headers: [
        {
          text: 'Nom de la Sous-Catégorie',
          align: 'start',
          value: 'nom',
        },
        { text: 'Nombre de Produit dans la sous-catégorie', value: 'nombre_produits'},
        { text: 'Catégorie', value: 'categorie'},
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      souscategories: [],
      categories : [],
      editedIndex: -1,
      editedItem: {
        nom: '',
        nombre_produits: 0,
        categorie:'',
        image:null,
      },
      defaultItem: {
        nom: '',
        nombre_produits: 0,
        categorie:'',
        image:null,
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nouvelle Sous-Catégorie' : 'Modifier la Sous-Catégorie'
      },
      dataCat() {
        let cats =  this.categories.map(cat => {
          return cat.nom ;
        });
        return cats;
      },
      imageUrl(){
        if(this.editedIndex > -1){
          return 'http://127.0.0.1:8000/public/images' + this.editedItem.image ;
        }
        return "";
      }
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
          axios.get(`http://127.0.0.1:8000/api/souscategorie`)
          .then(function (response) {
            obj.souscategories = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
          axios.get(`http://127.0.0.1:8000/api/categorie`)
          .then(function (response) {
            obj.categories = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
      editItem (item) {
        this.editedIndex = this.souscategories.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.editedItem.image = null ;
        this.dialog = true;
      },
      deleteItem (item) {
        this.editedIndex = this.souscategories.indexOf(item);
        this.dialog1 = true;
      },
      viewImage (item) {
        this.editedIndex = this.souscategories.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog2 = true;
      },
      close () {
        this.dialog = false;
        this.dialog1 = false;
        this.dialog2 = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        })
      },
      save () {
        let obj = this ;
        if (this.editedIndex > -1) {
          axios.patch(`http://127.0.0.1:8000/api/souscategorie/update/${obj.souscategories[obj.editedIndex].id}`,{nom:obj.editedItem.nom})
          .then(function (response) {
            obj.souscategories[obj.editedIndex].nom = obj.editedItem.nom;
            console.log(obj.souscategories[obj.editedIndex].nom);
          })
          .catch(function (error) {    
            console.log(error);
          });
        } else {
          if((obj.editedItem.nom!='')&&(obj.editedItem.categorie!='')){
            const formData = new FormData();
            formData.append('nom',obj.editedItem.nom);
            var cat = obj.categories.find(o => o.nom === obj.editedItem.categorie);
            formData.append('categorie_id',cat.id);
            formData.append('categorie',cat.nom);
            if(obj.editedItem.image!=null){
              formData.append('image',obj.editedItem.image);
            }
            axios.post(`http://127.0.0.1:8000/api/souscategorie/store`,formData)
            .then(function (response) {
              obj.souscategories.push(response.data.data);
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
        axios.delete(`http://127.0.0.1:8000/api/souscategorie/delete/${obj.souscategories[obj.editedIndex].id}`)
        .then(function (response) {
          console.log(response.data);
          obj.souscategories.splice(obj.editedIndex, 1);
        })
        .catch(function (error) {  
        console.log(error);
        });
        this.close()
      }
    },
  }
</script>

<style scoped>

</style>
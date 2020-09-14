<template>

  <v-data-table
    :headers="headers"
    :items="publicites"
    sort-by="titre"
    class="elevation-1"
  >

    <template v-slot:top>

      <v-toolbar flat>

        <v-toolbar-title> Mes Publicites </v-toolbar-title>

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
            > Ajouter une Publicité </v-btn>
          </template>

          <v-card light>
            <v-card-title>
              <span class="headline"> Nouvelle Publicité </span>
            </v-card-title>
            <v-card-text>
              <v-text-field color="#11999e" outlined  v-model="editedItem.titre" label="Titre"></v-text-field>
              <v-text-field color="#11999e" outlined  v-model="editedItem.sous_titre" label="Sous Titre"></v-text-field>
                <v-select
                    :items="types"
                    v-model="editedItem.type"
                    label="Type"
                    outlined
                    color="#11999e"
                ></v-select>  
              <v-file-input
                color="#11999e"
                v-model="editedItem.image"
                accept="image/png, image/jpeg, image/bmp"
                prepend-icon="mdi-camera"
                label="Photo du Publicite"
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
              <span class="headline"> Supprimer la Publicite ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez la publicite définitivement .
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
            &nbsp;&nbsp;&nbsp;&nbsp;
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
        { text: 'Titre', value: 'titre'},  
        {text: 'Sous-Titre',align: 'start',value: 'sous_titre',},
        { text: 'Type', value: 'type'},
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      publicites: [],
      types : [
          'Pub Principale',
          'Pub Secondaire(deuxième)',
          'Pub Secondaire(troisième)',
      ],
      typeD : [
          'first',
          'second',
          'third'
      ],
      editedIndex: -1,
      editedItem: {
        titre:'',
        sous_titre:'',
        type:'',
        image:null,
      },
      defaultItem: {
        titre:'',
        sous_titre:'',
        type:'',
        image:null,
      },
    }),

    computed: {
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
          axios.get(`http://127.0.0.1:8000/api/publicite`)
          .then(function (response) {
            obj.publicites = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
      deleteItem (item) {
        this.editedIndex = this.publicites.indexOf(item);
        this.dialog1 = true;
      },
      viewImage (item) {
        this.editedIndex = this.publicites.indexOf(item);
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
        if (this.editedIndex < 0) {
            if((obj.editedItem.partenaire!='')&&(obj.editedItem.titre!='')&&(obj.editedItem.description!='')&&(obj.editedItem.numero!='')&&(obj.editedItem.prix!=0)){
            const formData = new FormData();
            formData.append('titre',obj.editedItem.titre);
            formData.append('sous_titre',obj.editedItem.sous_titre);
            formData.append('type',obj.typeD[obj.types.indexOf(obj.editedItem.type)]);
            if(obj.editedItem.image!=null){
              formData.append('image',obj.editedItem.image);
            }
            axios.post(`http://127.0.0.1:8000/api/publicite/store`,formData)
            .then(function (response) {
              obj.publicites.push(response.data.data);
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
        axios.delete(`http://127.0.0.1:8000/api/publicite/delete/${obj.publicites[obj.editedIndex].id}`)
        .then(function (response) {
          console.log(response.data);
          obj.publicites.splice(obj.editedIndex, 1);
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
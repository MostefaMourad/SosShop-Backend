<template>
  <v-data-table
    :headers="headers"
    :items="faqs"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title> Mes FAQ ( Questions Fréquement posées ) </v-toolbar-title>
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
            > Ajouter une question </v-btn>
          </template>
          <v-card light>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container fluid>
                <v-row>
                  <v-col cols="12" sm="11" md="11" align="center">
                    <v-text-field color="#11999e" outlined  v-model="editedItem.question" label="Question"></v-text-field>
                    <v-textarea
                        outlined
                        clearable
                        counter
                        label="Réponse"
                        color="#11999e"
                        v-model="editedItem.reponse"
                    ></v-textarea>
                  </v-col>
                </v-row>
              </v-container>
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
              Si vous poursuivez cette action, vous supprimerez la question , ainsi, toutes les réponses associées seront également supprimées .
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
          text: 'Question',
          align: 'start',
          value: 'question',
        },
        { text: 'Réponse', value: 'reponse'},
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      faqs: [],
      editedIndex: -1,
      editedItem: {
        question: '',
        reponse: '',
      },
      defaultItem: {
        question: '',
        reponse: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nouvelle Question' : 'Modifier la Question'
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
          axios.get(`http://127.0.0.1:8000/api/faq`)
          .then(function (response) {
            obj.faqs = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },

      editItem (item) {
        this.editedIndex = this.faqs.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog = true;
      },

      deleteItem (item) {
        this.editedIndex = this.faqs.indexOf(item);
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
          axios.patch(`http://127.0.0.1:8000/api/faq/update/${obj.faqs[obj.editedIndex].id}`,{question:obj.editedItem.question,reponse:obj.editedItem.reponse})
          .then(function (response) {
            obj.faqs[obj.editedIndex].question = obj.editedItem.question;
            obj.faqs[obj.editedIndex].reponse = obj.editedItem.reponse;
            console.log(obj.faqs[obj.editedIndex]);
          })
          .catch(function (error) {    
            console.log(error);
          });
        } else {
          if((obj.editedItem.question!=null) && (obj.editedItem.reponse!=null)){
            axios.post(`http://127.0.0.1:8000/api/faq/store`,{question:obj.editedItem.question,reponse:obj.editedItem.reponse})
            .then(function (response) {
              obj.faqs.push(response.data.data);
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
        axios.delete(`http://127.0.0.1:8000/api/faq/delete/${obj.faqs[obj.editedIndex].id}`)
        .then(function (response) {
          console.log(response.data);
          obj.faqs.splice(obj.editedIndex, 1);
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
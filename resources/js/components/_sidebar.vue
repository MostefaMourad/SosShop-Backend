<template>
    <div>
    <v-navigation-drawer
      app
      clipped
      color="#11999e"
    >
      <v-list dense>
        <v-list-item two-line :class="'px-0'">
            <v-list-item-avatar>
              <img src="../assets/logo.png">
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>TOURATHI</v-list-item-title>
              <v-list-item-subtitle> préserver le passé </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-divider></v-divider>

        <v-list-item to="/admin/utilisateur">
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Utilisateurs</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item to="/admin/marker">
          <v-list-item-action>
            <v-icon>mdi-map-marker</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Markers</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item to="/admin/avis">
          <v-list-item-action>
            <v-icon>mdi-message-text</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Avis</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item to="/admin/reponse">
          <v-list-item-action>
            <v-icon>mdi-forum</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Reponses</v-list-item-title>
          </v-list-item-content>
        </v-list-item>  
      </v-list>
            <template v-slot:append>
        <div class="pa-2">
          <v-btn 
          block
          @click="ExportAvis"
          >EXPORT TO EXCEL</v-btn>
        </div>
      </template>
    </v-navigation-drawer>
    </div>
</template>

<script>
    export default {
      methods: {
              ExportAvis(){
                  window.open(`https://tourathi-dz.com/api/admin/export`, "_self");
              } ,
      },  
    }
</script>

<style scoped>

</style>
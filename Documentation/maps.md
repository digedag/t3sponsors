# Kartendarstellung

**Die Erweiterung wurde mit freundlicher Unterstützung der [Werbeagentur zeitlos aus Wiesloch](http://www.zeitlos.cc/) umgesetzt.**

Für die Darstellung der Firmen in der Listenansicht in einer Karte von Google-Maps ist die Installation der Extension wec_maps notwendig. Im HTML-Template muss lediglich der Marker **###SPONSORMAP###** hinzugefügt werden.

##Vorkonfigurierte Marker in der Karte
Es ist möglich in der Karte fest Punkte zu setzen, die immer angezeigt werden. Diese müssen per Typoscript konfiguriert werden:

```
plugin.tx_t3sponsors.sponsorlist.sponsor._map {
  poi.0 {
    lat = 49.13249
    lng = 8.84884
    description = <h3>Wichtig</h3><p>Ein Punkt auf der Karte.</p>
    zoomMin = 0
    zoomMax = 18
    icon1 {
      name = icon1
      image = IMG_RESOURCE
      image.file = fileadmin/logos/point.png
      image.file.maxH = 40
      image.file.maxW = 40
      shadow = IMG_RESOURCE
      shadow.file = fileadmin/logos/point.png
      shadow.file.maxH = 40
      shadow.file.maxW = 40
    }
  }
}

```

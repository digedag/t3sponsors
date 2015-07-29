# Listenausgabe mit Suchformular

Standardmäßig ist im Plugin ein Filter mit Suchformular konfiguriert. Wer dieses Formular **NICHT** benötigt kann mit folgender Anweisung den Standardfilter setzen:

```
plugin.tx_t3sponsors.sponsorlist.sponsor.filter.class = tx_rnbase_filter_BaseFilter

```

Man kann beim ersten Zugriff auf die Listenansicht mit aktivierten Suchformular eine Ausgabe der Ergebnisse unterdrücken. Dazu muss man folgende TS-Anweisung setzen:

```
plugin.tx_t3sponsors.sponsorlist.sponsor.filter.hideResultInitial = 1
```

## Kategorien und Branchen im Formular
Die Darstellung der Kategorien und Branchen im Formular kann wahlweise als Select-Box oder mit Checkboxen erfolgen. Man muss das entsprechend im HTML-Template und im Typoscript konfigurieren, damit die gewählten Einträge bei der Suche wieder markiert werden. 

### Branchen als Selectbox
```html
###TRADES###
<div class="form-group">
  <label for="t3sponsors_trade">###LABEL_TRADE###</label>
  <select class="form-control" name="t3sponsors[search_trade][]">
		<option value="">Bitte auswählen</option>
###TRADE###
		<option value="###TRADE_UID###" ###TRADE_SELECTED###>###TRADE_NAME###</option>
###TRADE###
  </select>
</div>
###TRADES###
```
Im Typoscript nun den Marker ###TRADE_SELECTED### konfigurieren:
```
plugin.tx_t3sponsors.sponsorlist.sponsor.filter.form.trade {
  selected.value = selected="selected"
}
```
### Branchen als Checkboxen
```
###TRADES###
<div class="form-group">
  <label>###LABEL_TRADE###</label>
###TRADE###
  <label class="checkbox-inline">
    <input type="checkbox" id="inlineCheckbox###TRADE_LINE###" name="t3sponsors[search_trade][]" value="###TRADE_UID###" ###TRADE_SELECTED### /> ###TRADE_NAME###
  </label>
###TRADE###
</div>
###TRADES###
```
Im Typoscript nun den Marker ###TRADE_SELECTED### konfigurieren:
```
plugin.tx_t3sponsors.sponsorlist.sponsor.filter.form.trade {
  selected.value = checked
}
```
Für die Kategorien ist die Umsetzung analog. Statt TRADE/trade verwendet man dann nur jeweils CATEGORY/category.


 
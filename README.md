# Offers Stack Wordpress Plugin

#### Install & Activate Plugin
Add short code in editor or page to load offers 
You can add additional settings like 

```
1- offers_keyword
2- widget_identifier
3- max_iteams
4- is_sidebar


#### calling widget in editor 

[offerstack offers_keyword="watch" widget_identifier='local' max_iteams='2']


#### calling widget in sidebar in code

do_shortcode("[offerstack is_sidebar='yes']");

```


Note: OfferStack API Key


`
offerstack_api_key=
` you can get API key form https://offerstack.io/


####Settings


```
1- Offers Keyword = offer will be listed as per this keyword
2- Max Items = no of items to list 
3- Widget Identifier = where this components is loaded on page 

example 
    a. page top
    b. page bottom
    c. right side base
    note:  Identifier will be sluify when send to api
```



TODO:
- [ ] move offersApiKey to plugin settings   

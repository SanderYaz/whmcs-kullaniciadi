
# whmcs-kullaniciadi #
WHMCS için Ücretsiz Kullanıcı Adı modülü

## Özet ##
Bu modül, müşterilerinize benzersiz bir kullanıcı adıyla müşteri paneline giriş yapmalarını sağlar.

## Minimum Gereksinimler ##

- WHMCS >= 6.0
- PHP >= 5.4.0

WHMCS 7.7.1 ve PHP 7.3 ile de testleri gerçekleştirilmiştir.

WHMCS'nin minimum gereksinimlerini görmek için https://docs.whmcs.com/System_Requirements adresine göz atabilirsiniz.

## Özellikler ##
- Açık kaynak
- Özelleştirilebilir bilgi mesajları
- Rezerve edilebilir kullanıcı adları

## Kurulum ##
Projeyi herhangi bir yere klonlayabilir ya da GitHub üzerinden son sürümü indirebilirsiniz. Sürümler için [releases](https://github.com/aponkral/whmcs-kullaniciadi/releases) sayfasına göz atın.

#### Clone ####
Repoyu klonlayacaksanız herhangi bir yere klonladıktan sonra proje dizinine gidip kullaniciadi klasörünü WHMCS_dizininiz/modules/addons dizini içerisine taşımalısınız;

```
# cd whmcs-kullaniciadi
# mv kullaniciadi WHMCS_dizininiz/modules/addons/.
```

#### Son sürümü indirin (önerilen kurulum) ####
[Buradan](https://github.com/aponkral/whmcs-kullaniciadi/releases) son sürümü indirdikten sonra WHMCS_dizininiz/modules/addons dizinine dosyaları çıkartın.

Modülün çalışması için 1 tane "özel müşteri alanı" oluşturmanız gerekiyor. Bu kullanıcı adını almak için olmalı.

Kurulumu tamamlamak için WHMCS admin sayfanızdan "Setup -> Addon Modules" sayfasına gidip modülü etkinleştirin. Etkinleştirdikten sonra "Configure" butonuna tıklayarak Kullanıcı Adı için oluşturduğunuz "Özel Alan"ı seçmelisiniz.

## Özel Müşteri Alanları ##
*Kullanıcı Adı alanı;*
- Alan İsmi: Kullanıcı Adı
- Alan Türü: Metin Kutusu
- Seçenekler: Zorunlu alan, Sipariş formunda göster

## Ekran Görüntüleri ##
![Ekran görüntüsü 1](https://github.com/aponkral/whmcs-kullaniciadi/raw/master/screenshoots/whmcs-kullaniciadi-Screenshot-1.png "Ekran görüntüsü 1")

![Ekran görüntüsü 2](https://github.com/aponkral/whmcs-kullaniciadi/raw/master/screenshoots/whmcs-kullaniciadi-Screenshot-2.png "Ekran görüntüsü 2")

## Etiketler ##
- Tam Açık Kaynak Kodlu
- WHMCS
- Eklenti
- Modül
- WHMCS için Kullanıcı Adı Eklentisi
- WHMCS için Ücretsiz Kullanıcı Adı Eklentisi
- WHMCS için Kullanıcı Adı Modülü
- WHMCS için Ücretsiz Kullanıcı Adı Modülü
- WHMCS için Modül
- WHMCS için Eklenti
- Ücretsiz
- Özelleştirilebilen bilgi mesajları


Bu modül [APONKRAL Apps](https://aponkral.net/apps/) tarafından tam açık kaynak kodlu olarak yayınlandığı için tüm geliştiriciler tarafından geliştirilebilir.

---

# whmcs-kullaniciadi #
A Username addon for WHMCS

## Summary ##
This module offers your customers to login the customer panel with their unique username.

## Minimum Requirements ##
- WHMCS >= 6.0
- PHP >= 5.4.0

Works with WHMCS 7.7.1 and PHP 7.3, too.

For the latest WHMCS minimum system requirements, please refer to
https://docs.whmcs.com/System_Requirements

## Features ##
- Open source
- Customizable information messages
- Reservable usernames

## Installation ##
You can install this module by cloning the repo or downloading the latest release from GitHub. See the [releases](https://github.com/aponkral/whmcs-kullaniciadi/releases) page.

#### Cloning the repo ####
Clone the repo to anywhere you like and move the "kullaniciadi" directory to your WHMCS modules/addons directory;

```
# cd whmcs-kullaniciadi
# mv kullaniciadi WHMCSroot/modules/addons/.
```

#### Downloading the latest release (Recommended!) ####
You can download the latest release and unzip it directly to your WHMCSroot/modules/addon directory.

Module needs one Custom Fields to be created in WHMCS. Should hold the customer's username.

To complete the installation, you should go to your WHMCS admin area and click "Activate" in your "Setup -> Addon Modules" page. Then click "Configure" and select the appropriate fields you created before.

## Custom Client Fields ##
*Username field;*
- Field Name: Username
- Field Type: Text Box
- Options: Required field, Show on order form

## Screenshoots ##
![Screenshot 1](https://github.com/aponkral/whmcs-kullaniciadi/raw/master/screenshoots/whmcs-kullaniciadi-Screenshot-1.png "Screenshot 1")

![Screenshot 2](https://github.com/aponkral/whmcs-kullaniciadi/raw/master/screenshoots/whmcs-kullaniciadi-Screenshot-2.png "Screenshot 2")

## Tags ##
- Full Open Source
- WHMCS
- Plugin
- Module
- Username Plugin for WHMCS
- Username free Plugin for WHMCS
- Username Module for WHMCS
- Username free Module for WHMCS
- Module for WHMCS
- Plugin for WHMCS
- Free
- Customizable information messages


This module can be developed by all developers as [APONKRAL Apps](https://aponkral.net/apps/) is released as full open source code.
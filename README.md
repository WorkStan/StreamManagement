# StreamManagement

## How to install
- Download ant-media-server-community-2.4.3.zip to current directory
- Run ```make init```
- Run ```make permissions```
- Replace the values in ```backend\.env```
```
  ANT_MEDIA_BASE_URI="http://antmedia:5080/LiveApp/rest/"
  ANT_MEDIA_RTMP_HOST="localhost:5080"
  EXTERNAL_PLAYER_LINK="http://localhost:5080/LiveApp/play.html"
```
- Enjoy it!
- Don't forget Disable REST API Security (Disable IP Filter for testing)

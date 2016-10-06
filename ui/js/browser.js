function localStorage(t,k,v='') {
  if(window.localStorage){
    var storage = window.localStorage;
    switch(t){
      case 'set':
        storage.setItem(k,v);
        break;
      case 'get':
        return storage.getItem(k);
        break;
      case 'getAll':
        var tmp = '{';
        for(var i=0;i<storage.length;i++){
          tmp += '"'+i+'":"'+storage.getItem(storage.key(i))+'",';
        }
        tmp = tmp.replace('/,$','')+'}';
        return tmp;
      case 'remove':
        storage.removeItem(k);
        break;
    }
  }else{
    alert('该浏览器不支持LocalStorage');
  }
}
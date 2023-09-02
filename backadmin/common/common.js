/**
 * Created by Ravi on 22-07-2017.
 */

function invalidate_parsley(id)
{
    // debugger;
    id = '#' + id;
    $(id).parsley().reset();
}


Array.prototype.containsArray = function (array /*, index, last*/)
{

    if (arguments[1])
    {
        var index = arguments[1], last = arguments[2];
    }
    else
    {
        var index = 0, last = 0;
        this.sort();
        array.sort();
    }

    return index == array.length
        || ( last = this.indexOf(array[index], last) ) > -1
        && this.containsArray(array, ++index, ++last);

};
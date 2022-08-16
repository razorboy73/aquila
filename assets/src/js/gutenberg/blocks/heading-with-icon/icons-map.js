//want to render an icon based on a component selection
import { isEmpty } from "lodash";
import * as SvgIcons from "../../../icons";
//call this function from the edit file

export const getIconComponent = (option) => {
  const IconsMap = {
    dos: SvgIcons.Check,
    donts: SvgIcons.Cross,
  };
  //check the option is not missing and is in the icon map, if nothing there, return dos as default
  return !isEmpty(option) && option in IconsMap
    ? IconsMap[option]
    : IconsMap["dos"];
};
